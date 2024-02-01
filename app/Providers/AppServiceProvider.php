<?php

namespace App\Providers;

use App\Contracts\WeatherDataCollectionInterface;
use App\Services\WeatherDataService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            WeatherDataCollectionInterface::class,
            WeatherDataService::class
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
