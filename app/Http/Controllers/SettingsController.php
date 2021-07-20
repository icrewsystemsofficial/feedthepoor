<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SettingsController extends Controller
{
    public function activity() {

        $activities = Activity::orderBy('id', 'DESC')->get();
        
        return view('settings.activity')->with('activities', $activities);
    }
    public function user_module(){
        $data = User::all();
       //$permission = Permission::create(['name' => 'admin']);

        return view ('settings.user_module' )->with(compact('data', $data ));

    }
    public function user_edit($id){
        //echo "hello";
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
        //->causedBy('admin')
        ->log('updated the user '.$data->name.' by user module');
        return redirect(route('user.fetch'));
    }
    public function delete($id){
        
        $data=User::find($id);
        $data->delete();
       // notify()->success("Successfully Deleted","deleted");
       activity()
       ->causedBy('admin')
       ->log('deleted the user '.$data->name.' by user module');
        return redirect(route('user.fetch'));

    }
}
