<?php

namespace App\User\Repositories;

use App\User\Models\User;
use App\User\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function find(int $id): ?User
    {
        return User::find($id);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function findByTelegramId(int $telegramId): ?User
    {
        return User::where('telegram_id', $telegramId)->first();
    }

    public function create(array $attributes): User
    {
        return User::create($attributes);
    }
}
