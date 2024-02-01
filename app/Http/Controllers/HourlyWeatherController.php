<?php

namespace App\Http\Controllers;

use App\Models\HourlyWeather;
use App\Models\WeatherData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class HourlyWeatherController extends Controller
{
    /**
     * Display a listing of the hourly weather data.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Retrieve all hourly weather data with associated weather data and location
        $hourlyWeather = HourlyWeather::with('weatherData.location')->get();

        // Render the 'HourlyWeather/Index' view with the retrieved hourly weather data
        return inertia('HourlyWeather/Index', [
            'hourlyWeather' => $hourlyWeather,
        ]);
    }

    /**
     * Show the form for creating a new hourly weather entry.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        // Retrieve all weather data with associated locations
        $weatherdata = WeatherData::with('location')->get();

        // Render the 'HourlyWeather/Create' view with the retrieved weather data
        return inertia('HourlyWeather/Create', compact('weatherdata'));
    }

    /**
     * Store a newly created hourly weather entry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'weatherdata_id' => 'required|exists:weather_data,id',
                'time' => 'required|date',
                'type' => 'required|string',
                'value' => 'required|numeric',
            ]
        );


        if ($validator->fails()) {
            // Redirect to the 'HourlyWeather.index' route after validator fails
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            // Create the HourlyWeather instance with the validated data

            HourlyWeather::create($validator);

            
            // Redirect to the 'hourly-weather.index' route after successful update
            return redirect()->route('hourly-weather.index');
        }
        // Create a new HourlyWeather instance with the validated data

        // Redirect to the 'hourly-weather.index' route after successful storage
        return redirect()->route('hourly-weather.index');
    }

    /**
     * Display the specified hourly weather entry.
     *
     * @param  HourlyWeather $hourlyWeather
     * @return \Inertia\Response
     */
    public function show(HourlyWeather $hourlyWeather)
    {
        // Render the 'HourlyWeather/Show' view with the retrieved hourly weather entry
        return inertia('HourlyWeather/Show', compact('hourlyWeather'));
    }

    /**
     * Show the form for editing the specified hourly weather entry.
     *
     * @param  HourlyWeather $hourlyWeather
     * @return \Inertia\Response
     */
    public function edit(HourlyWeather $hourlyWeather)
    {
        // Retrieve all weather data with associated locations
        $weatherdata = WeatherData::with('location')->get();

        // Render the 'HourlyWeather/Edit' view with the retrieved hourly weather entry and weather data
        return inertia('HourlyWeather/Edit', compact('hourlyWeather', 'weatherdata'));
    }

    /**
     * Update the specified hourly weather entry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  HourlyWeather $hourlyWeather
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, HourlyWeather $hourlyWeather)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'weatherdata_id' => 'required|exists:weather_data,id',
                'time' => 'required|date',
                'type' => 'required|string',
                'value' => 'required|numeric',
            ]
        );


        if ($validator->fails()) {
            // Redirect to the 'HourlyWeather.index' route after validator fails
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            // Create the HourlyWeather instance with the validated data

            HourlyWeather::updateOrCreate([
                'id'=>$validator['weatherdata_id']
            ],$validator);

            
            // Redirect to the 'hourly-weather.index' route after successful update
            return redirect()->route('hourly-weather.index');
        }
        

    }

    /**
     * Remove the specified hourly weather entry from storage.
     *
     * @param  HourlyWeather $hourlyWeather
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(HourlyWeather $hourlyWeather)
    {
        // Delete the specified hourly weather entry
        $hourlyWeather->delete();

        // Redirect to the 'hourly-weather.index' route after deletion
        return redirect()->route('hourly-weather.index');
    }
}
