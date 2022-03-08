<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index(){
        $locations = Location::all();
        return view('admin.location.index', compact('locations'));        
    }
    
    public function manage(Location $location){
        return view('admin.location.manage', compact('location'));
    }

    public function update(Request $request, Location $location){
        $request->validate([
            'location_name' => 'required|string',
            'location_description' => 'required|string',
            'location_address' => 'required|string',
            'location_pin_code' => 'required|numeric|max:999999|min:100000',
            'location_latitude' => 'required|string|max:12',
            'location_longitude' => 'required|string|max:13',
            'location_manager_id' => 'required|numeric',
            'location_status' => 'required|in:0,1,2,3',
        ]);
        $location->update($request->all());
        return redirect(route('admin.location.index'));
    }

    public function destroy(Location $location){
        $location->delete();
        return redirect(route('admin.location.index'));
    }
}
