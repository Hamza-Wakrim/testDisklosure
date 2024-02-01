<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherData extends Model
{
    use HasFactory;
    protected $fillable = [
        'location_id',
        'generationtime_ms',
        'elevation',
        'hourly_units',
    ];

    protected $casts = [
        'hourly_units' => 'array',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function hourlyWeather()
    {
        return $this->hasMany(HourlyWeather::class, 'weatherdata_id');
    }
}
