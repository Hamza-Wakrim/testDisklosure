<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'latitude',
        'longitude',
        'timezone',
        'timezone_abbreviation',
        'utc_offset_seconds',
    ];
    public function weatherData()
    {
        return $this->hasMany(WeatherData::class);
    }

    public function hourly_data()
    {
        return $this->weatherData()->get()->map(
            function($item) {

                return $item->hourlyWeather()->get([ "id", "time", "value"])->toArray();
            }
        )->flatten(1)->toArray();
    }
}
