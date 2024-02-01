<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HourlyWeather extends Model
{
    use HasFactory;
    protected $fillable = [
        'weatherdata_id',
        'time',
        'type',
        'value',
    ];

    public function weatherData()
    {
        return $this->belongsTo(WeatherData::class, 'weatherdata_id');
    }
}
