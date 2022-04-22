<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\NotificationHelper;
use App\Models\User;
use App\Notifications\GeneralNotification;

class DashboardController extends Controller
{
    public function index() {
        // Auth::user()->notify(new GeneralNotification(
        //     $body = 'VOMM - Airport has been updated',
        //     $title = 'Flight Operations',
        //     $action = 'occ/admin/flightops/airports',
        //     $type = '0',
        //     $icon = 'shield',
        //     $color = 'warning')
        // );
        // NotificationHelper::notify()->users(Auth::user())->content("Check","Working");
        return view('admin.dashboard.index');
    }

    public function profile() {
        return "coming soon";
    }

    public function edit_profile(Request $request) {
        return "This is a POST method";
    }

    public function mark_as_read($user_id) {

        $response = array();

        $user = User::find($user_id);
        if($user) {
            $user->unreadNotifications->markAsRead();
            $response['message'] = 'Marked all notifications as read.';
            $response['code'] = '200';
        } else {
            $response['message'] = 'Unable to find user with ID # '.$user_id.'';
            $response['code'] = '400';
        }

        return response($response);
    }
}
