<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\User;
use App\TempUser;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Mail\UserInivitationMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function activity() {
        $activities = Activity::orderBy('id', 'DESC')->get();
        return view('settings.activity')->with('activities', $activities);
    }

    public function user_module(){
        $data = User::all();
        return view ('settings.user_module' )->with(compact('data', $data ));
    }

    public function user_edit($id){
        $data=User::find($id);
       return view('settings.user_module_edit',compact('data'));
    }

    public function update(Request $req){
        $data=User::find($req->id);
        $data->name=$req->input('name');
        $data->email= $req->input('email');
        $role= $req->input('role');
        $data->save();
        $data->revokePermissionTo($role);
        $data->syncRoles([$role]);
       // notify()->success("Successfully Updated","updated");
       activity()
        ->causedBy(Auth::user()->id)
        ->log('updated the user '.$data->name.' by user module');
        // notify()->success("Successfully sent mail","sent");
        return redirect(route('user.fetch'));
    }
    public function delete($id){
        $data=User::find($id);
        $data->delete();
        activity()
       ->causedBy(Auth::user()->id)
       ->log('Deleted the user '.$data->name.' by user module');
     // notify()->success("Successfully Deleted","deleted");
        return redirect(route('user.fetch'));

    }
    public function create_index(){
        return view('settings.create_user_module');

    }

    public function create(Request $req){
        $tempuser = new TempUser;
        $uuid = Str::uuid()->toString();
        $tempuser->name=$req->input('name');
        $tempuser->email= $req->input('email');
        $tempuser->role= $req->input('role');
        $tempuser->unique_code= $uuid;
        activity()
        ->causedBy(Auth::user()->id)
        ->log('Created a invitation link to  the user '.$tempuser->name.' by user module');
        Mail::to($tempuser->email)->send(new UserInivitationMail($tempuser));
        
        $tempuser->save();
        return redirect(route('user.fetch'));
               // notify()->success("Successfully sent mail","sent");

    }
    public function create_user_inivitation($unique_code){
        $data=TempUser::where('unique_code',$unique_code) -> first();
       return view('settings.password',compact('data'));

    } 
    public function create_user_inivitation_create(Request $req){
        $user = new User;
        $user->name=$req->input('name');
        $user->last_name=$req->input('name');
        $user->email= $req->input('email');
        $user->password= $req->input('password');
        $role= $req->input('role');
        $user->givePermissionTo($role);
        $user->assignRole($role);
        $user->save();

        $delete_user_temp=TempUser::find($req->input('id'));
        $delete_user_temp->delete();
        activity()
        ->causedBy($user)
        ->log('Created a new user called '.$user->name.'');
       // notify()->success("Successfully Created","created");
       return view('/welcome');

    } 
}
