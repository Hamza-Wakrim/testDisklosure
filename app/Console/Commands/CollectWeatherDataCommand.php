<?php

namespace App\Console\Commands;

use App\Jobs\FetchWeatherData;
use App\Services\WeatherDataService;
use Illuminate\Console\Command;

class CollectWeatherDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:weather {latitude} {longitude} {--hourly=temperature_2m}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect weather data From API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting weather data collection...');

        // Retrieve command line arguments and options.
        $latitude = $this->argument('latitude');
        $longitude = $this->argument('longitude');
        $hourly = $this->option('hourly');

        // Dispatch the FetchWeatherData job.
        FetchWeatherData::dispatch(
            $latitude, $longitude, $hourly,
            app(WeatherDataService::class)
        );

        $this->info('Weather data collection will be completed shortly.');
    }
}
