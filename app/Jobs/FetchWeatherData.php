<?php

namespace App\Jobs;

use App\Contracts\WeatherDataCollectionInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchWeatherData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param float $latitude The latitude of the location.
     * @param float $longitude The longitude of the location.
     * @param string $hourly The hourly data type (e.g., 'temperature', 'precipitation').
     * @param WeatherDataCollectionInterface $weatherDataService The service responsible for collecting weather data.
     */
    public function __construct(
        protected float $latitude, protected float $longitude, protected string $hourly,
        protected WeatherDataCollectionInterface $weatherDataService
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Delegate the weather data collection to the injected service.
        $this->weatherDataService->collectWeatherData(
            $this->latitude, $this->longitude, $this->hourly
        );
    }
}
