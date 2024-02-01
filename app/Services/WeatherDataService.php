<?php

namespace App\Services;

use App\Contracts\WeatherDataCollectionInterface;
use App\Exceptions\DataNotSavedException;
use App\Models\Location;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherDataService implements WeatherDataCollectionInterface
{
    /**
     * Collects weather data from a specified API based on latitude, longitude, and hourly data.
     *
     * @param float $latitude The latitude of the location.
     * @param float $longitude The longitude of the location.
     * @param string $hourly The hourly data type (e.g., 'temperature', 'precipitation').
     * @return bool Returns true if data collection is successful, otherwise false.
     */
    public function collectWeatherData(float $latitude, float $longitude, string $hourly) :bool
    {
        // Get the weather API URL from the configuration.
        $weatherApi = config('weather.weatherApi');

        // Make an HTTP request to the weather API with specified parameters.
        $response = Http::withOptions([
            'verify' => storage_path('app/public/cacert.pem'),
        ])->get($weatherApi, [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'hourly' => $hourly,
        ]);

        // Check if the API request was successful.
        if ($response->successful()) {
            // Extract and process the data from the API response.
            $data = collect($response->json());

            // Store the weather data in the database.
            try {

                DB::beginTransaction();

                $this->storeWeatherData($data, $hourly);

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                // Log the exception or handle it in a way that makes sense for your application.
                Log::error('Error saving weather data to the database: ' . $e->getMessage());

                // Throw a more specific exception.
                throw new DataNotSavedException('Error saving weather data to the database.', 0, $e);
            }
            $this->storeWeatherData($data, $hourly);

            // Return true to indicate successful data collection.
        }
        return true;
    }

    /**
     * Stores weather data in the database for a given location and hourly type.
     *
     * @param Collection $dataCollection The collection of weather data from the API response.
     * @param string $hourly The hourly data type (e.g., 'temperature', 'precipitation').
     * @return void
     */
    protected function storeWeatherData(Collection $dataCollection , string $hourly)
    {
        // Extract location data from the collection.
        $location = Location::firstOrCreate([
            'latitude' => $dataCollection->get("latitude"),
            'longitude' => $dataCollection->get("longitude"),
            'timezone' => $dataCollection->get('timezone'),
            'timezone_abbreviation' => $dataCollection->get('timezone_abbreviation'),
            'utc_offset_seconds' => $dataCollection->get('utc_offset_seconds'),
        ]);

        $weatherData = $location->weatherData()->create([
            'generationtime_ms' => $dataCollection->get('generationtime_ms'),
            'elevation' => $dataCollection->get('elevation'),
            'hourly_units' => $dataCollection->get('hourly_units'),
        ]);

        collect($dataCollection->get('hourly')[$hourly])
        ->each(function($temperature, $index) use ($weatherData, $dataCollection, $hourly) {
            $weatherData->hourlyWeather()->create([
                'time' => collect($dataCollection->get('hourly')['time'])->get($index),
                'type' => $hourly,
                'value' => $temperature,
            ]);
        });
    }
}
