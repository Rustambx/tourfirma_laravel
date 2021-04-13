<?php

namespace App\Modules\City;

use App\Modules\City\Services\CityService;
use Illuminate\Support\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');

        $this->loadViewsFrom(__DIR__.'/Views', 'city');
    }

    public function register(): void
    {
        $this->app->singleton(CityService::class, function () {
            return new CityService();
        });

        $this->app->alias(CityService::class, 'city');
    }
}
