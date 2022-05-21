<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Location;
use App\Models\Mission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operations;
use App\Helpers\NotificationHelper;
use App\Models\Donations;
use App\Mail\MissionCancelledDonorMail;
use App\Events\Missions\MissionCreateOrUpdate;

class NewMission{
    public $id = null;
    public $description = '';
    public $location_id = 0;
    public $field_manager_id = 0;
    public $execution_date = '';
    public $mission_status = 0;
    public $assigned_volunteers = [];
    public $procurment_items = [];
}

class MissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $active_missions = Mission::where('mission_status', '!=', Mission::$status['COMPLETED'])->get();
        $locations = Location::all();
        $active_volunteers = User::where('volunteer', 1)->where('available_for_mission', 1)->get();

        $procurement_items = Operations::where('status', 4)->get();
        $total_procurement_items = Operations::where('status', 4)->count();
        //dd($procurement_items);

        return view('admin.missions.index', [
            'active_missions' => $active_missions,
            'active_volunteers' => $active_volunteers,
            'procurement_items' => $procurement_items,
            'total_procurement_items' => $total_procurement_items,
            'locations' => $locations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $location_id = Location::where('location_name', $request->location_id)->first()->id;
        $active_volunteers = User::where('volunteer', 1)->where('available_for_mission', 1)->where('location_id', $location_id)->get();        
        $procurement_items = Operations::where('status', 4)->where('location_id', $location_id)->get();        
        $field_managers = $active_volunteers; //Update code when a permission "is_mission_manager" is defined
        return view('admin.missions.create', [
            'active_volunteers' => $active_volunteers,
            'procurement_items' => $procurement_items,
            'location' => $request->location_id,
            'field_managers' => $field_managers,
        ]);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $request->validate([
            'description' => 'required',
            'execution_date' => 'required',
            'location' => 'required',
            'field_manager_id' => 'required',
            'assigned_volunteers' => 'required',
        ]);
        $mission = new NewMission();
        $mission->description = $request->description;
        $mission->location_id = Location::where('location_name', $request->location)->first()->id;
        $mission->field_manager_id = $request->field_manager_id;
        $mission->execution_date = $request->execution_date;
        $mission->mission_status = 0;
        $mission->assigned_volunteers = json_encode($request->assigned_volunteers);
        $procurement_items = array();
        foreach($request->all() as $key => $value){
            if(strpos($key, 'procurement_item_') !== false){
                $procurement_items[] = explode('_', $key)[2];
            }
        }        
        $mission->procurement_items = json_encode($procurement_items);        
        event(new MissionCreateOrUpdate($mission, 1));
        alert()->success('Mission Created Successfully', 'Success');
        return redirect()->route('admin.missions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage(Request $request)
    {
        $mission = Mission::find($request->mission_id);
        $location_id = $mission->location_id;
        $active_volunteers = User::where('volunteer', 1)->where('available_for_mission', 1)->where('location_id', $location_id)->get();        
        $field_managers = $active_volunteers; //Update code when a permission "is_mission_manager" is defined
        $procurement_items = Operations::where('status', 4)->where('location_id', $location_id)->get();        
        return view('admin.missions.manage', [
            'mission' => $mission,
            'procurement_items' => json_decode($mission->procurement_items),
            'active_volunteers' => $active_volunteers,
            'volunteers' => json_decode($mission->assigned_volunteers),
            'location' => $request->location_id,
            'field_managers' => $field_managers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
            'execution_date' => 'required',
            'location' => 'required',
            'field_manager_id' => 'required',
            'assigned_volunteers' => 'required',
            'id' => 'required|exists:missions,id',
            'mission_status' => 'required|numeric|in:0,1,2,3,4',
        ]);
        $mission = new NewMission();
        $mission->id = $request->id;
        $mission->description = $request->description;
        $mission->location_id = Location::where('location_name', $request->location)->first()->id;
        $mission->field_manager_id = $request->field_manager_id;
        $mission->execution_date = $request->execution_date;
        $mission->mission_status = $request->mission_status;
        $mission->assigned_volunteers = json_encode($request->assigned_volunteers);
        $procurement_items = array();
        foreach($request->all() as $key => $value){
            if(strpos($key, 'procurement_item_') !== false){
                $procurement_items[] = explode('_', $key)[2];
            }
        }
        $mission->procurement_items = json_encode($procurement_items);        
        event(new MissionCreateOrUpdate($mission, 0));
        alert()->success('Mission Updated Successfully', 'Success');
        return redirect()->route('admin.missions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $reason = $request->reason;
        $personnel = array();
        array_push($personnel, $request->field_manager_id);        
        $mission = Mission::find($request->mission_id);
        foreach(json_decode($mission->assigned_volunteers) as $volunteer) {
            array_push($personnel, $volunteer);
        }
        $notification = new NotificationHelper;
        $notification->users($personnel)->content('Mission #'.$mission->id.' has been cancelled by user #'.auth()->user()->id.' ('.auth()->user()->name.') for the following reason(s)<br><br>'.$reason)->notify();
        $procurement_items = json_decode($mission->procurement_items);
        $donors = array();
        foreach ($procurement_items as $item) {
            $operation = Operations::find($item);
            $operation->status = 4;
            $operation->save();
            array_push($donors, User::find(Donations::find($operation->donoation_id)->first()->donor_id)->first()->email);
        }
        $mission->delete();
        foreach ($donors as $donor) {
            \Mail::to($donor)->send(new MissionCancelledDonorMail($reason));
        }
        alert()->success('Mission cancelled successfully', 'Success');
        return redirect()->route('admin.missions.index');
    }
}
