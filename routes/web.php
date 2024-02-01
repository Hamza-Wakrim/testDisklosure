<?php

use App\Http\Controllers\ChartsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\WeatherDataController;
use App\Http\Controllers\HourlyWeatherController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function(){
    return redirect()->route('locations.index');
});

Route::resource('locations', LocationController::class);
Route::resource('weather-data', WeatherDataController::class);
Route::resource('hourly-weather', HourlyWeatherController::class);