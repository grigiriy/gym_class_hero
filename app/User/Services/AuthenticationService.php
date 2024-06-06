<?php

namespace App\User\Services;

use App\User\Models\User;
use App\User\Repositories\Contracts\UserRepositoryInterface;
use App\User\Services\Contracts\AuthenticationServiceInterface;

class AuthenticationService implements AuthenticationServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function authenticateByTelegram(int $telegramId): ?User
    {
        return $this->userRepository->findByTelegramId($telegramId);
    }
}
