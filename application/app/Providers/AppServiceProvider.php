<?php

namespace App\Providers;

use App\Services\Auth\LoginService;
use App\Services\Auth\LoginServiceInterface;
use App\Services\Habit\HabitService;
use App\Services\Habit\HabitServiceInterface;
use App\Services\ProgressMark\ProgressMarkInterface;
use App\Services\ProgressMark\ProgressMarkService;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            UserServiceInterface::class,
            UserService::class
        );

        $this->app->singleton(
            LoginServiceInterface::class,
            LoginService::class
        );

        $this->app->singleton(
            HabitServiceInterface::class,
            HabitService::class
        );

        $this->app->singleton(
            ProgressMarkInterface::class,
            ProgressMarkService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
