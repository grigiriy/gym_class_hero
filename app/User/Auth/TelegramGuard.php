<?php

namespace App\User\Auth;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TelegramGuard implements Guard
{
    private ?Authenticatable $user = null;
    private bool $hasValidated = false;

    public function __construct(
        private UserProvider $provider,
        private Request $request,
        private string $botToken
    ) {}

    public function user(): ?Authenticatable
    {
        if ($this->hasValidated) {
            return $this->user;
        }

        $this->hasValidated = true;
        $this->user = $this->resolveUser();

        return $this->user;
    }

    public function id(): mixed
    {
        $user = $this->user();

        return $user?->getAuthIdentifier();
    }

    public function validate(array $credentials = []): bool
    {
        return $this->user() !== null;
    }

    public function setUser(Authenticatable $user): void
    {
        $this->user = $user;
        $this->hasValidated = true;
    }

    public function hasUser(): bool
    {
        return $this->user() !== null;
    }

    public function guest(): bool
    {
        return !$this->hasUser();
    }

    public function check(): bool
    {
        return $this->hasUser();
    }

    private function resolveUser(): ?Authenticatable
    {
        $initData = $this->getInitData();

        if (!$initData) {
            return null;
        }

        $validated = $this->validateInitData($initData);

        if (!$validated) {
            return null;
        }

        $telegramData = $this->parseInitData($initData);

        if (!$telegramData || !isset($telegramData['user'])) {
            return null;
        }

        $user = $this->provider->retrieveByCredentials([
            'telegram_id' => $telegramData['user']['id'],
        ]);

        if (!$user) {
            $user = $this->provider->createModel();

            if ($user) {
                $user->fill([
                    'name' => $telegramData['user']['first_name']
                        . (isset($telegramData['user']['last_name'])
                            ? ' ' . $telegramData['user']['last_name']
                            : ''),
                    'email' => $telegramData['user']['id'] . '@telegram.local',
                    'telegram_id' => $telegramData['user']['id'],
                    'telegram_username' => $telegramData['user']['username'] ?? null,
                    'password' => bcrypt(Str::random(32)),
                ]);

                $user->save();
            }
        }

        return $user;
    }

    private function getInitData(): ?string
    {
        $header = $this->request->header('Authorization', '');

        if (preg_match('/^tma\s+(.+)$/i', $header, $matches)) {
            return $matches[1];
        }

        return null;
    }

    public function validateInitData(string $initData): bool
    {
        $parsed = parse_url('?' . $initData, PHP_URL_QUERY);

        if (!$parsed) {
            return false;
        }

        parse_str($parsed, $data);

        if (!isset($data['hash'])) {
            return false;
        }

        $hash = $data['hash'];
        unset($data['hash']);

        ksort($data);

        $dataCheckString = [];
        foreach ($data as $key => $value) {
            $dataCheckString[] = $key . '=' . $value;
        }

        $dataCheckString = implode("\n", $dataCheckString);

        $secretKey = hash_hmac('sha256', $this->botToken, 'WebAppData');
        $computedHash = hash_hmac('sha256', $dataCheckString, $secretKey);

        return hash_equals($computedHash, $hash);
    }

    private function parseInitData(string $initData): ?array
    {
        $parsed = parse_url('?' . $initData, PHP_URL_QUERY);

        if (!$parsed) {
            return null;
        }

        parse_str($parsed, $data);

        if (isset($data['user'])) {
            $data['user'] = json_decode($data['user'], true);
        }

        return $data;
    }
}
