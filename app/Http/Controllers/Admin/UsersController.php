<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index($role = ''){
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
}
