<?php

namespace App\Modules\Hotel;

use App\Modules\Hotel\Services\HotelService;
use Illuminate\Support\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');

        $this->loadViewsFrom(__DIR__.'/Views', 'hotel');
    }

    public function register(): void
    {
        $this->app->singleton(HotelService::class, function () {
            return new HotelService();
        });

        $this->app->alias(HotelService::class, 'hotel');
    }
}
