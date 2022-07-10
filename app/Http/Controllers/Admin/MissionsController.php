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
use App\Models\MissionAssignment;

use App\Jobs\Missions\MissionNotifications;
use App\Jobs\NotifyAllAdmins;

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
        $active_volunteers = User::permission('is_volunteer')->where('location_id', $location_id)->get();
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
        $mission->assigned_volunteers = $request->assigned_volunteers;
        $procurement_items = array();
        foreach($request->all() as $key => $value){
            if(strpos($key, 'procurement_item_') !== false){
                $procurement_items[] = explode('_', $key)[2];
            }
        }
        $mission->procurement_items = $procurement_items;        
        event(new MissionCreateOrUpdate($mission, 1));

        alert()->success('Mission Created Successfully', 'Success');
        NotifyAllAdmins::dispatch('New mission created', 'A new mission has been created by '.auth()->user()->name, 'ALL', route('admin.missions.index'));
        return redirect()->route('admin.missions.index');
    }

    /**
     * Display the volunteer/field manager response page
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reply_index(Request $request)
    {
        $request->validate([
            'mission_id' => 'required|exists:missions,id',
            'user_id' => 'required|exists:user,id',
        ]);
        $mission = Mission::find($request->mission_id);
        $location = Location::find($mission->location_id);
        $active_volunteers = User::where('volunteer', 1)->where('available_for_mission', 1)->where('location_id', $location->id)->get();
        $procurement_items = Operations::where('status', 4)->where('location_id', $location->id)->get();
        $field_managers = $active_volunteers; //Update code when a permission "is_mission_manager" is defined
        return view('admin.missions.reply', [
            'mission' => $mission,
            'location' => $location,
            'active_volunteers' => $active_volunteers,
            'procurement_items' => $procurement_items,
            'field_managers' => $field_managers,
            'user_id' => $request->user_id,
        ]);
    }

    /**
     * Accept the volunteer/field manager
     *
     * @param  mixed $request
     * @return void
     */
    public function reply_accept(Request $request)
    {
        $request->validate([
            'mission_id' => 'required|exists:missions,id',
            'user_id' => 'required|exists:user,id',
            'reply' => 'required|in:1,2'
        ]);
        $assignment = MissionAssignment::where('mission_id', $request->mission_id)->where('user_id', $request->user_id)->first();
        $assignment->status = $request->reply;
        $assignment->save();
        alert()->success('Mission Accepted Successfully', 'Success');
    }

    /**
     * Reject the volunteer/field manager
     *
     * @param  mixed $request
     * @return void
     */
    public function reply_reject(Request $request)
    {
        $request->validate([
            'mission_id' => 'required|exists:missions,id',
            'user_id' => 'required|exists:user,id',
            'reply' => 'required|in:1,2',
            'reason' => 'required|string'
        ]);
        $name = User::find($request->user_id)->name;
        $assignment = MissionAssignment::where('mission_id', $request->mission_id)->where('user_id', $request->user_id)->first();
        $assignment->status = $request->reply;
        $assignment->save();
        $notification = new NotificationHelper();
        $notification->user([1])->content('User '.$name.' has rejected being a part of Mission #'.$request->mission_id.' citing the reason <br>'.$request->reason)->notify();//Replace with method to notify all SUs
        alert()->success('Mission Rejected Successfully', 'Success');
    }

    /**
     * Display the specified mission details
     *
     * @param  mixed $request
     * @return void
     */
    public function details(Request $request)
    {
        $request->validate([
            'mission_id' => 'required|exists:missions,id',
        ]);
        $mission = Mission::find($request->mission_id);
        $location = Location::find($mission->location_id);
        $procurement_items = Operations::whereIn('id', json_decode($mission->procurement_items))->get();
        $field_manager = User::find($mission->field_manager_id);
        $users = MissionAssignment::where('mission_id', $mission->id)->get();
        $volunteers = array();
        foreach($users as $user){
            $volunteers[] = [$user->user_id, User::find($user->user_id)->name, $user->status];
        }
        return view('admin.missions.show', [
            'mission' => $mission,
            'location' => $location,
            'procurement_items' => $procurement_items,
            'field_manager' => $field_manager,
            'volunteers' => $volunteers,//Get all users assigned to this mission and their status
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage(Request $request)
    {
        $mission = Mission::find($request->id);
        $location_id = $mission->location_id;
        $active_volunteers = User::where('volunteer', 1)->where('available_for_mission', 1)->where('location_id', $location_id)->get();
        $field_managers = $active_volunteers; //Update code when a permission "is_mission_manager" is defined
        $procurement_items_loc = Operations::where('status', 4)->where('location_id', $location_id)->get();
        return view('admin.missions.manage', [
            'mission' => $mission,
            'procurement_items' => json_decode($mission->procurement_items),
            'active_volunteers' => $active_volunteers,
            'volunteers' => json_decode($mission->assigned_volunteers),
            'procurement_items_loc' => $procurement_items_loc,
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
        $mission->assigned_volunteers = $request->assigned_volunteers;
        $procurement_items = array();
        foreach($request->all() as $key => $value){
            if(strpos($key, 'procurement_item_') !== false){
                $procurement_items[] = explode('_', $key)[2];
            }
        }
        $mission->procurement_items = $procurement_items;
        event(new MissionCreateOrUpdate($mission, 0));
        alert()->success('Mission Updated Successfully', 'Success');
        NotifyAllAdmins::dispatch('Mission Updated', 'Mission #'.$request->id.' has been updated by '.auth()->user()->name, 'ALL', route('admin.missions.index'));
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
        NotifyAllAdmins::dispatch('Mission Cancelled', 'Mission #'.$mission->id.' has been cancelled by '.auth()->user()->name, 'ALL');
        return redirect()->route('admin.missions.index');
    }

    /**
     * validate_directory - If path does not exist, create.
     *
     * @param  mixed $path
     * @return void
     */
    public function validate_directory($path) {
        if(!File::isDirectory($path)){
            if(File::makeDirectory($path, 0777, true, true)) {
                return true;
            } else {
                # Unable to create directory.
                return false;
            }

        } else {
            return true;
        }
    }

    /**
     * upload mission images to the server
     *
     * @param  mixed $request
     * @return void
     */
    public function upload(Request $request){

        if ($request->hasFile('mission_images')) {
            $file = $request->file('mission_images');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $path = storage_path('missions' . DIRECTORY_SEPARATOR . 'tmp');
            if($this->validate_directory($path)) {
                $folder = $file->store('missions' . DIRECTORY_SEPARATOR . 'tmp');
                return $folder;
            } else {
                return false;
            }
        }
        return false;
    }

    /**
     * Add mission images and make it available for user download
     *
     * @param  mixed $request
     * @return void
     */
    public function mission_images(Request $request){
        $request->validate([
            'mission_images_id' => 'required|exists:missions,id',
            'mission_images' => 'required',
        ]);
        $count = 0;
        foreach($request->mission_images as $image){
            $count++;
            $info = pathinfo($image);
            $ext = $info['extension'];
            $filename = 'missions/'.$request->mission_images_id.'/image_'.$count.'.'.$ext;
            Storage::disk('local')->move($image, 'public/'.$filename);
            Storage::disk('local')->delete($image);
        }
    }
}
