<?php

namespace App\Providers;

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Привязка интерфейса UserRepositoryInterface к его реализации UserRepository
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        // Также здесь могут быть регистрации других сервисов и интерфейсов
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
