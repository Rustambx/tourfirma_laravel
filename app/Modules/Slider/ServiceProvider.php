<?php

namespace App\Modules\Slider;

use App\Modules\Slider\Services\SliderService;
use Illuminate\Support\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');

        $this->loadViewsFrom(__DIR__.'/Views', 'slider');
    }

    public function register(): void
    {
        $this->app->singleton(SliderService::class, function () {
            return new SliderService();
        });

        $this->app->alias(SliderService::class, 'slider');
    }
}
