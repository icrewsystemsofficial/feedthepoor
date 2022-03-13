<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index($role = 'administrator'){
        $location = Location::all();
        $users = User::role($role)->get();
        return view('admin.users.index', compact('users', 'location', 'role'));
    }

    public function view(){
        $location = Location::all();
        $user = Auth::user();
        return view('admin.users.view', compact('location', 'user'));
    }

    public function update(Request $req, $id){
        $user = User::find($id);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->pan_number = $req->pan_number;
        $user->phone_number = $req->phone_number;
        $user->address = $req->address;
        $user->location_id = $req->location_id;
        $user->save();
        return(redirect(route('admin.dashboard')));
    }

    public function create(Request $req, $role){
        $user = new User;
        $user->name = $req->input('user_name');
        $user->email = $req->input('user_email');
        $user->password = $req->input('user_password');
        $user->phone_number = $req->input('user_phone_number');
        $user->location_id = $req->input('user_location_id');
        $user->assignRole($role);
        $user->save();
        return(redirect()->back());
    }

    public function destroy($id){
        $user = User::find($id);
        alert()->success('Yay','User "'.$user->name.'" was successfully deleted');
        $user->delete();
        return redirect()->back();
    }
}
