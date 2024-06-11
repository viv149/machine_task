<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LocationController extends Controller
{
    
    private function point2point_distance($lat1, $lon1, $lat2, $lon2, $unit='K') 
    { 
        $theta = $lon1 - $lon2; 
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
        $dist = acos($dist); 
        $dist = rad2deg($dist); 
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") 
        {
            return ($miles * 1.609344); 
        } 
        else if ($unit == "N") 
        {
            return round($miles * 0.8684);
        } 
        else 
        {
        return $miles;
      }
    }   

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $location = Location::first();
        return view('location', compact('location'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lat1' => 'required|numeric',
            'log1' => 'required|numeric',
            'lat2' => 'required|numeric',
            'log2' => 'required|numeric',
        ]);
        
        $lat1 = $request->input('lat1');
        $log1 = $request->input('log1');
        $lat2 = $request->input('lat2');
        $log2 = $request->input('log2');

        
        $distance = $this->point2point_distance($lat1, $log1, $lat2, $log2, 'K');
        // dd($distance);

        $location = Location::first();
        if(!$location) {
            $location = new Location();
        } 
        $location->lat1 = $request->input('lat1');
        $location->log1 = $request->input('log1');
        $location->lat2 = $request->input('lat2');
        $location->log2 = $request->input('log2');
        $location->distance = $distance;
 
        try{
            $location->save();
            return Redirect::back()->with('distance', $distance, 'success', 'Distance get successfully!');
        }catch(Exception $e){
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
