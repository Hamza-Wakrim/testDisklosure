<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\WeatherData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class WeatherDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Retrieve all weather data with associated locations
        $weatherData = WeatherData::with('location')->get();

        // Render the 'WeatherData/Index' view with the retrieved data
        return inertia('WeatherData/Index', compact("weatherData"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        // Retrieve all locations
        $locations = Location::all();

        // Render the 'WeatherData/Create' view with the retrieved locations
        return inertia('WeatherData/Create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData =  Validator::make($request->all(),[
            'location_id' => 'required|exists:locations,id',
            'generationtime_ms' => 'required|numeric',
            'elevation' => 'required|numeric',
            'hourly_units' => 'json|nullable',
        ]);

        if ($validatedData->fails()) {
            // Redirect to the 'weather-data.index' route after validator fails
            return redirect()->back()->withErrors($validatedData)->withInput();
        }else{
            // Create a new WeatherData instance with the validated data
            WeatherData::create([
                'location_id' => $validatedData['location_id'],
                'generationtime_ms' => $validatedData['generationtime_ms'],
                'elevation' => $validatedData['elevation'],
                'hourly_units' => [
                    'time' => $request->input('time_unit'),
                    'temperature_2m' => $request->input('temperature_2m')
                ],
            ]);

        // Redirect to the 'weather-data.index' route after successful storage
            return redirect()->route('weather-data.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $weatherDataId
     * @return \Inertia\Response
     */
    public function show($weatherDataId)
    {
        // Find WeatherData by its ID
        $weatherData = WeatherData::findOrFail($weatherDataId);

        // Render the 'WeatherData/Show' view with the retrieved WeatherData
        return inertia('WeatherData/Show', compact("weatherData"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $weatherDataId
     * @return \Inertia\Response
     */
    public function edit($weatherDataId)
    {
        // Find WeatherData by its ID
        $weatherData = WeatherData::findOrFail($weatherDataId);

        // Retrieve all locations
        $locations = Location::all();

        // Render the 'WeatherData/Edit' view with the retrieved WeatherData and locations
        return inertia('WeatherData/Edit', compact('locations','weatherData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $weatherDataId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $weatherDataId)
    {
        // Validate the incoming request data
        $validatedData =  Validator::make($request->all(),[
            'location_id' => 'required|exists:locations,id',
            'generationtime_ms' => 'required|numeric',
            'elevation' => 'required|numeric',
            'hourly_units' => 'json|nullable',
        ]);

        if ($validatedData->fails()) {
            // Redirect to the 'weather-data.index' route after validator fails
            return redirect()->back()->withErrors($validatedData)->withInput();
        }else{
            // Find WeatherData by its ID
            $weatherData = WeatherData::findOrFail($weatherDataId);

            // Update WeatherData attributes from the request
            $weatherData->location_id = $request->input('location_id');
            $weatherData->generationtime_ms = $request->input('generationtime_ms');
            $weatherData->elevation = $request->input('elevation');

            // Format and set the hourly_units attribute
            $hourly_units = [
                "time" => $request->input('time'),
                "temperature_2m" => $request->input('temperature_2m')
            ];
            $weatherData->hourly_units = $hourly_units;

            // Save the updated WeatherData instance to the database
            $weatherData->save();

            // Redirect to the 'weather-data.index' route after successful update
            return redirect()->route('weather-data.index');
        }        
    }

    public function destroy(WeatherData $weatherData)
    {
        $weatherData->delete();

        return redirect()->route('weather-data.index');
    }
}
