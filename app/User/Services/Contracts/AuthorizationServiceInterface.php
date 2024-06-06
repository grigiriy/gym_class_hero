<?php

namespace App\User\Services\Contracts;

use App\User\Models\User;

interface AuthorizationServiceInterface
{
    public function check(User $user, string $action): bool;
}
