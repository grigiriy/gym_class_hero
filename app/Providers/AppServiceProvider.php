<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Training\Repositories\Contracts\TrainingRepositoryInterface;
use App\Training\Repositories\TrainingRepository;
use App\Training\Services\Contracts\TrainingServiceInterface;
use App\Training\Services\TrainingService;
use App\Exercise\Repositories\Contracts\ExerciseRepositoryInterface;
use App\Exercise\Repositories\ExerciseRepository;
use App\Exercise\Services\Contracts\ExerciseServiceInterface;
use App\Exercise\Services\ExerciseService;
use App\Set\Repositories\Contracts\SetRepositoryInterface;
use App\Set\Repositories\SetRepository;
use App\Set\Services\Contracts\SetServiceInterface;
use App\Set\Services\SetService;
use App\Workout\Repositories\Contracts\WorkoutRepositoryInterface;
use App\Workout\Repositories\WorkoutRepository;
use App\Workout\Services\Contracts\WorkoutServiceInterface;
use App\Workout\Services\WorkoutService;
use App\User\Repositories\Contracts\UserRepositoryInterface;
use App\User\Repositories\UserRepository;
use App\User\Services\Contracts\AuthenticationServiceInterface;
use App\User\Services\AuthenticationService;
use App\User\Services\Contracts\AuthorizationServiceInterface;
use App\User\Services\AuthorizationService;
use App\User\Auth\TelegramGuard;
use App\User\Auth\TelegramUserProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Repositories
        $this->app->bind(TrainingRepositoryInterface::class, TrainingRepository::class);
        $this->app->bind(ExerciseRepositoryInterface::class, ExerciseRepository::class);
        $this->app->bind(SetRepositoryInterface::class, SetRepository::class);
        $this->app->bind(WorkoutRepositoryInterface::class, WorkoutRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        // Services
        $this->app->bind(TrainingServiceInterface::class, TrainingService::class);
        $this->app->bind(ExerciseServiceInterface::class, ExerciseService::class);
        $this->app->bind(SetServiceInterface::class, SetService::class);
        $this->app->bind(WorkoutServiceInterface::class, WorkoutService::class);
        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationService::class);
        $this->app->bind(AuthorizationServiceInterface::class, AuthorizationService::class);
    }

    public function boot(): void
    {
        Auth::provider('telegram', function ($app, array $config) {
            return new TelegramUserProvider();
        });

        Auth::extend('telegram', function ($app, $name, array $config) {
            $provider = Auth::createUserProvider($config['provider'] ?? null);

            return new TelegramGuard(
                $provider,
                $app['request'],
                $app['config']['services.telegram.bot_token'] ?? ''
            );
        });
    }
}
