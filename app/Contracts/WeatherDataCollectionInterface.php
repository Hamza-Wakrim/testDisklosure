<?php

namespace App\Contracts;

use App\Models\Location;

interface WeatherDataCollectionInterface
{
    public function collectWeatherData(float $latitude, float $longitude, string $hourly) :bool;
}
