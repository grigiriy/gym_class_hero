<?php

namespace App\User\Auth;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\User\Models\User;

class TelegramUserProvider implements UserProvider
{
    public function retrieveById($identifier): ?Authenticatable
    {
        return User::find($identifier);
    }

    public function retrieveByToken($identifier, $token): ?Authenticatable
    {
        return null;
    }

    public function updateRememberToken(Authenticatable $user, $token): void
    {
    }

    public function retrieveByCredentials(array $credentials): ?Authenticatable
    {
        if (!isset($credentials['telegram_id'])) {
            return null;
        }

        return User::where('telegram_id', $credentials['telegram_id'])->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials): bool
    {
        return true;
    }

    public function rehashPasswordIfRequired(Authenticatable $user, array $credentials, bool $force = false): void
    {
    }

    public function createModel(): Authenticatable
    {
        return new User();
    }
}
