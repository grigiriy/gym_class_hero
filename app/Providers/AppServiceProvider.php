<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Training\Repositories\Contracts\TrainingRepositoryInterface;
use App\Training\Repositories\TrainingRepository;
use App\Exercise\Repositories\Contracts\ExerciseRepositoryInterface;
use App\Exercise\Repositories\ExerciseRepository;
use App\Set\Repositories\Contracts\SetRepositoryInterface;
use App\Set\Repositories\SetRepository;
use App\Workout\Repositories\Contracts\WorkoutRepositoryInterface;
use App\Workout\Repositories\WorkoutRepository;
use App\User\Repositories\Contracts\UserRepositoryInterface;
use App\User\Repositories\UserRepository;
use App\User\Services\Contracts\AuthenticationServiceInterface;
use App\User\Services\AuthenticationService;
use App\User\Services\Contracts\AuthorizationServiceInterface;
use App\User\Services\AuthorizationService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TrainingRepositoryInterface::class, TrainingRepository::class);
        $this->app->bind(ExerciseRepositoryInterface::class, ExerciseRepository::class);
        $this->app->bind(SetRepositoryInterface::class, SetRepository::class);
        $this->app->bind(WorkoutRepositoryInterface::class, WorkoutRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationService::class);
        $this->app->bind(AuthorizationServiceInterface::class, AuthorizationService::class);
    }

    public function boot(): void
    {
        //
    }
}
