<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Project\Repositories\Interfaces\ProjectRepositoryInterface;
use Modules\Project\Repositories\ProjectRepository;
use Modules\Task\Repositories\Interfaces\TaskRepositoryInterface;
use Modules\Task\Repositories\TaskRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Passport::ignoreRoutes();
    }
}
