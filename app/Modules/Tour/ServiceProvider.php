<?php

namespace App\Modules\Tour;

use App\Modules\Tour\Services\GalleryService;
use App\Modules\Tour\Services\TourService;
use Illuminate\Support\ServiceProvider as BaseProvider;
use function foo\func;

class ServiceProvider extends BaseProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');

        $this->loadViewsFrom(__DIR__.'/Views', 'tour');
    }

    public function register(): void
    {
        $this->app->singleton(TourService::class, function () {
            return new TourService();
        });

        $this->app->singleton(GalleryService::class, function () {
            return new GalleryService();
        });

        $this->app->alias(TourService::class, 'tour');

        $this->app->alias(GalleryService::class, 'gallery');
    }
}
