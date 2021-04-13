<?php

namespace App\Modules\Navigation;

use App\Modules\Navigation\Services\NavigationService;
use Illuminate\Support\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');

        $this->loadViewsFrom(__DIR__.'/Views', 'navigation');
    }

    public function register(): void
    {
        $this->app->singleton(NavigationService::class, function () {
            return new NavigationService();
        });

        $this->app->alias(NavigationService::class, 'navigation');

    }
}
