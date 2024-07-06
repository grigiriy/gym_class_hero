<?php

namespace App\Auth\Providers;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\User\Models\User;

class TelegramUserProvider implements UserProvider
{
    public function retrieveByIdentifier($identifier)
    {
        return User::where('telegram_id', $identifier)->first();
    }

    public function retrieveByCredentials(array $credentials)
    {
        $telegramId = $credentials['telegram_id'] ?? null;

        if (!$telegramId) {
            return null;
        }

        return User::where('telegram_id', $telegramId)->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return true;
    }

    public function rehashPasswordIfRequired(Authenticatable $user, array $credentials, bool $force = false)
    {
    }
}
