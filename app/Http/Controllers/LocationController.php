<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LocationController extends Controller
{
    /**
     * Display a listing of the locations.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Retrieve all locations
        $locations = Location::all();

        // Render the 'Locations/Index' view with the retrieved locations
        return inertia('Locations/Index', [
            'locations' => $locations,
        ]);
    }

    /**
     * Display the specified location.
     *
     * @param  Location $location
     * @return \Inertia\Response
     */
    public function show(Location $location)
    {
        // Render the 'Locations/Show' view with the retrieved location
        return inertia('Locations/Show', [
            'location' => $location,
        ]);
    }

    /**
     * Show the form for creating a new location.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        // Render the 'Locations/Create' view for creating a new location
        return inertia('Locations/Create');
    }

    /**
     * Store a newly created location in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'latitude' => 'required|numeric|between:-90.000000,90.000000',
                'longitude' => 'required|numeric|between:-180.000000,180.000000',
                'timezone' => 'required|string|max:50',
                'timezone_abbreviation' => 'required|string|max:10',
                'utc_offset_seconds' => 'required|integer',
            ]
        );


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            
            Location::create($validator);
            
            return redirect()->route('locations.index')->with('success', 'Location was created!');
        }
        // Create a new Location instance with the validated data
        

        // Redirect to the 'locations.index' route after successful storage
    }

    /**
     * Show the form for editing the specified location.
     *
     * @param  Location $location
     * @return \Inertia\Response
     */
    public function edit(Location $location)
    {
        // Render the 'Locations/Edit' view with the retrieved location
        return inertia('Locations/Edit', [
            'location' => $location,
        ]);
    }

    /**
     * Update the specified location in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Location $location
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Location $location)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer|exists:locations,id',
                'latitude' => 'required|numeric|between:-90.000000,90.000000',
                'longitude' => 'required|numeric|between:-180.000000,180.000000',
                'timezone' => 'required|string|max:50',
                'timezone_abbreviation' => 'required|string|max:10',
                'utc_offset_seconds' => 'required|integer',
            ]
        );


        if ($validator->fails()) {
            // Redirect to the 'locations.index' route after validator fails
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            // Update the Location instance with the validated data

            Location::updateOrCreate([
                'id' => $validator['id']
            ],$validator);
            
            // Redirect to the 'locations.index' route after successful update
            return redirect()->route('locations.index');
        }

 
    }

    /**
     * Remove the specified location from storage.
     *
     * @param  Location $location
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Location $location)
    {
        // Delete the specified location
        $location->delete();

        // Redirect to the 'locations.index' route after deletion
        return redirect()->route('locations.index');
    }
}
