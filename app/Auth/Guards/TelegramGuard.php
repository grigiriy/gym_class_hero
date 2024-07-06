<?php

namespace App\Auth\Guards;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use App\Auth\Services\TelegramInitDataVerifier;
use App\User\Models\User;

class TelegramGuard implements Guard
{
    protected $request;
    protected $provider;
    protected $user;
    protected string $botToken;

    public function __construct(UserProvider $provider, Request $request, string $botToken = '')
    {
        $this->provider = $provider;
        $this->request = $request;
        $this->botToken = $botToken;
    }

    public function user()
    {
        if ($this->user !== null) {
            return $this->user;
        }

        $this->user = $this->authenticate();

        return $this->user;
    }

    public function id()
    {
        $user = $this->user();
        return $user ? $user->getAuthIdentifier() : null;
    }

    public function validate(array $credentials = [])
    {
        return false;
    }

    public function setUser(Authenticatable $user)
    {
        $this->user = $user;
    }

    public function check()
    {
        return $this->user() !== null;
    }

    public function guest()
    {
        return !$this->check();
    }

    protected function authenticate(): ?User
    {
        $token = $this->getTokenForRequest();

        if (!$token) {
            return null;
        }

        $verifier = new TelegramInitDataVerifier($this->botToken);

        if (!$verifier->verify($token)) {
            return null;
        }

        $telegramUser = $verifier->getUserData($token);
        if (!$telegramUser) {
            return null;
        }

        $user = User::firstOrCreate(
            ['telegram_id' => $telegramUser['id']],
            [
                'name' => trim(($telegramUser['first_name'] ?? '') . ' ' . ($telegramUser['last_name'] ?? '')),
                'email' => 'tg_' . $telegramUser['id'] . '@telegram.local',
                'password' => bcrypt('telegram'),
                'telegram_username' => $telegramUser['username'] ?? null,
            ]
        );

        $this->user = $user;

        return $user;
    }

    protected function getTokenForRequest(): ?string
    {
        $header = $this->request->header('Authorization');

        if ($header && str_starts_with($header, 'tma ')) {
            return substr($header, 4);
        }

        return null;
    }
}
