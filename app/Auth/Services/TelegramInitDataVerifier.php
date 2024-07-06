<?php

namespace App\Auth\Services;

class TelegramInitDataVerifier
{
    private string $botToken;

    public function __construct(string $botToken = '')
    {
        $this->botToken = $botToken ?: config('services.telegram.bot_token', '');
    }

    public function verify(string $initData): bool
    {
        if (empty($this->botToken)) {
            return false;
        }

        $data = $this->parseInitData($initData);
        if (!$data) {
            return false;
        }

        $hash = $data['hash'] ?? '';
        unset($data['hash']);

        $dataCheckString = $this->buildDataCheckString($data);
        $secretKey = hash_hmac('sha256', $this->botToken, 'WebAppData');
        $calculatedHash = hash_hmac('sha256', $dataCheckString, $secretKey);

        if (!hash_equals($calculatedHash, $hash)) {
            return false;
        }

        $authDate = (int) ($data['auth_date'] ?? 0);
        if ($authDate < time() - 86400) {
            return false;
        }

        return true;
    }

    public function getUserData(string $initData): ?array
    {
        $data = $this->parseInitData($initData);
        if (!$data || !isset($data['user'])) {
            return null;
        }

        $user = json_decode($data['user'], true);
        if (!$user || !isset($user['id'])) {
            return null;
        }

        return $user;
    }

    private function parseInitData(string $initData): ?array
    {
        $result = [];
        $pairs = explode('&', $initData);

        foreach ($pairs as $pair) {
            $parts = explode('=', $pair, 2);
            if (count($parts) === 2) {
                $key = urldecode($parts[0]);
                $value = urldecode($parts[1]);
                $result[$key] = $value;
            }
        }

        return !empty($result) ? $result : null;
    }

    private function buildDataCheckString(array $data): string
    {
        ksort($data);

        $pairs = [];
        foreach ($data as $key => $value) {
            $pairs[] = "{$key}={$value}";
        }

        return implode("\n", $pairs);
    }
}
