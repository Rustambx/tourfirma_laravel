<?php

namespace App\Modules\News;

use App\Modules\News\Services\NewsService;
use Illuminate\Support\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');

        $this->loadViewsFrom(__DIR__.'/Views', 'news');
    }

    public function register()
    {
        $this->app->singleton(NewsService::class, function () {
            return new NewsService();
        });

        $this->app->alias(NewsService::class, 'news');
    }
}
