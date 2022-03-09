<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('admin.dashboard.index');
    }

    public function profile() {
        return "coming soon";
    }

    public function edit_profile(Request $request) {
        return "This is a POST method";
    }
}
