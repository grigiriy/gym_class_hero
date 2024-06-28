<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\User\Models\User;
use Symfony\Component\HttpFoundation\Response;

class DevAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->environment('local') && !$request->user()) {
            $user = User::firstOrCreate(
                ['email' => 'dev@local.test'],
                [
                    'name' => 'Dev User',
                    'password' => bcrypt('password'),
                    'telegram_id' => 1,
                ]
            );
            auth()->login($user);
        }

        return $next($request);
    }
}
