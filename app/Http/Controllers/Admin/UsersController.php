<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\User;
use App\Models\Donations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index(){
        $allRoles = Role::all();
        $location = Location::all();
        $role = 'admin';
        $users = User::all();
        $admins = User::role('administrator')->get();
        $volunteers = User::role('volunteer')->get();
        $donors = User::role('donor')->get();
        return view('admin.users.index', compact('users', 'admins', 'volunteers', 'donors', 'location', 'role', 'allRoles'));
    }

    public function view(){
        $allRoles = Role::all();
        $location = Location::all();
        $user = Auth::user();
        $all_donations = Donations::all()->where('donor_id', Auth::user()->id);
        return view('admin.users.view', compact('location', 'user', 'allRoles', 'all_donations'));
    }


    public function manage($id){
        $location = Location::all();
        $user = User::find($id);
        $allRoles = Role::all();
        $all_donations = Donations::all()->where('donor_id', $id);
        return view('admin.users.view', compact('location', 'user', 'allRoles', 'all_donations'));
    }

    public function update(Request $req, $id){
        $user = User::find($id);
        $roles = $user->getRoleNames();
        $user->removeRole($roles[0]);
        $user->assignRole($req->input('user_role'));
        $user->name = $req->name;
        $user->email = $req->email;
        $user->assignRole($req->input('user_role'));
        $user->pan_number = $req->pan_number;
        $user->phone_number = $req->phone_number;
        $user->address = $req->address;
        $user->location_id = $req->location_id;
        if ($req->hasFile('avatar')) {

            $path = $req->file('avatar')->store('public/avatars');

            $url = Storage::url($path);

            $imgpath = str_replace('/storage', storage_path() . '/app/public', $url);

            $img = Image::make($imgpath);

            $img->fit(250);

            $img->save();

            $user->avatar = $url;
        }
        $user->save();

        return redirect()->route('admin.users.index');
    }

    public function update_password(Request $req, $id){
        $this->validate($req, [
            'curr_password' => 'curr_password|required',
            'new_password' => 'new_password|required',
        ]);
        $user = User::find($id);
        if($user->password == $req->curr_password){
            $user->password = $req->new_password;
            return(redirect(route('admin.dashboard')));
        }else{
            alert()->error('OOPS!','The Password you enetered is incorrect');
            return redirect()->back();
        }
    }

    public function create(Request $req){
        $this->validate($req, [
            'user_name' => 'required',
            'user_email' => 'required',
            'user_password' => 'required',
            'user_address' => 'required',
            'user_location_id' => 'required',
            'user_role' => 'required',
        ]);
        $user = new User;
        $user->name = $req->input('user_name');
        $user->email = $req->input('user_email');
        $user->password = $req->input('user_password');
        $user->address = $req->input('user_address');
        $user->phone_number = $req->input('user_phone_number');
        $user->location_id = $req->input('user_location_id');
        $user->assignRole($req->input('user_role'));
        $user->save();
        return(redirect()->back());
    }

    public function destroy($id){
        $user = User::find($id);
        alert()->success('Yay','User "'.$user->name.'" was successfully deleted');
        $user->delete();
        return (redirect(route('admin.users.index')));
    }
}
