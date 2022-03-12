<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index($role = ''){
        $location = Location::all();
        $users = User::all();
        return view('admin.users.index', compact('users', 'location', 'role'));
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
