<?php

namespace App\User\Repositories\Contracts;

use App\User\Models\User;

interface UserRepositoryInterface
{
    public function find(int $id): ?User;
    public function findByEmail(string $email): ?User;
    public function findByTelegramId(int $telegramId): ?User;
    public function create(array $attributes): User;
}
