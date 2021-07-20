<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Models\User;

class SettingsController extends Controller
{
    public function activity() {

        $activities = Activity::orderBy('id', 'DESC')->get();
        
        return view('settings.activity')->with('activities', $activities);
    }
    
  
}
