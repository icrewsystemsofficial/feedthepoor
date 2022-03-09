<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\User;

class LocationController extends Controller
{
    public function index(){
        $locations = Location::all();
        return view('admin.location.index', compact('locations'));        
    }
    
    public function manage(Request $request, Location $location){    
        $location = Location::find($request->id);
        $locations = Location::all();
        $location_names = array();
        foreach ($locations as $loc) {
            if (!in_array($loc->location_name, $location_names)) {
                array_push($location_names, $loc->location_name);
            }
        }
        $location->location_name_list = $location_names;    
        $users = User::all();
        $location_managers = array();
        foreach ($users as $user) {
            $location_managers[$user->id] = $user->name;
        }   
        $location->location_manager_list = $location_managers;        
        return view('admin.location.manage', compact('location'));
    }

    public function update(Request $request, Location $location){
        $location = Location::find($request->id);
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
        return redirect(route('admin.location.index'))->with('success', 'Location updated successfully');
    }

    public function destroy(Request $request, Location $location){
        $location = Location::find($request->id);
        $location->delete();
        return redirect(route('admin.location.index'))->with('success', 'Location deleted successfully');
    }
}