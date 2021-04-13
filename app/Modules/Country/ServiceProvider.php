<?php

namespace App\Modules\Country;

use App\Modules\Country\Services\CountryService;
use Illuminate\Support\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');

        $this->loadViewsFrom(__DIR__.'/Views', 'country');
    }

    public function register(): void
    {
        $this->app->singleton(CountryService::class, function () {
            return new CountryService();
        });

        $this->app->alias(CountryService::class, 'country');
    }
}
