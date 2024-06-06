<?php

namespace App\User\Services\Contracts;

interface AuthenticationServiceInterface
{
    public function authenticateByTelegram(int $telegramId): ?object;
}
