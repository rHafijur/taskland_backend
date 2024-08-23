<?php

namespace App\Providers;

use App\Services\TaskService;
use App\Services\UserService;
use App\Services\ProjectService;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\TaskRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ProjectRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });

        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(TaskService::class, function ($app) {
            return new TaskService($app->make(TaskRepositoryInterface::class));
        });

        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(ProjectService::class, function ($app) {
            return new ProjectService($app->make(ProjectRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
