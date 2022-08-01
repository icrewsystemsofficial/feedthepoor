<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\User;
use App\Jobs\NotifyAllAdmins;

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

    public function update(Request $request){
        $request->validate([
            'location_name' => 'required|string',
            'location_description' => 'required|string',
            'location_address' => 'required|string',
            'location_pin_code' => 'required|numeric|max:999999|min:100000',
            'location_latitude' => 'required|string|max:12',
            'location_longitude' => 'required|string|max:13',
            'location_manager_id' => 'required',
            'location_status' => 'required|in:0,1,2,3',
        ]);
        $location = Location::find($request->id);
        $location->update($request->all());
        alert()->success('Yay','Location "'.$request->location_name.'" was successfully updated');
        NotifyAllAdmins::dispatch('Location modified', 'A location '.$request->location_name.' has been modified by '.auth()->user()->name, 'ALL', route('admin.location.manage', $location->id))->delay(now());
        return redirect(route('admin.location.index'));
    }

    public function destroy(Request $request){
        $location = Location::find($request->id);
        $location->delete();
        alert()->success('Yay','Location "'.$location->location_name.'" was successfully deleted');        
        NotifyAllAdmins::dispatch('Location deleted', 'A location '.$location->location_name.' has been deleted by '.auth()->user()->name, 'ALL')->delay(now());
        return redirect(route('admin.location.index'));
    }

    public function store(Request $request){
        $request->validate([
            'location_name' => 'required|string',
            'location_description' => 'required|string',
            'location_address' => 'required|string',
            'location_pin_code' => 'required|numeric|max:999999|min:100000',
            'location_latitude' => 'required|string|max:12',
            'location_longitude' => 'required|string|max:13',
            'location_manager_id' => 'required',
            'location_status' => 'required|in:0,1,2,3',
        ]);
        $location = Location::create($request->all());
        $location = $location->fresh();
        alert()->success('Yay','Location "'.$request->location_name.'" was successfully deleted');
        NotifyAllAdmins::dispatch('New location created', 'A new location '.$request->location_name.' has been created by '.auth()->user()->name, 'ALL', route('admin.location.manage', $location->id))->delay(now());
        return redirect(route('admin.location.index'));
    }
}
