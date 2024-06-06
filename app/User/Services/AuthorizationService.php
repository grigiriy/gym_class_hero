<?php

namespace App\User\Services;

use App\User\Models\User;
use App\User\Services\Contracts\AuthorizationServiceInterface;

class AuthorizationService implements AuthorizationServiceInterface
{
    public function check(User $user, string $action): bool
    {
        return true;
    }
}
