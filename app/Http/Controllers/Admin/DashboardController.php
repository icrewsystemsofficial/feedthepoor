<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\NotificationHelper;
use App\Models\User;
use App\Notifications\GeneralNotification;
use App\Models\Donations;
use App\Models\Operations;
use App\Models\Location;

class DashboardController extends Controller
{
    public function index() {
        $donations_today = Donations::where('created_at', '>=', date('Y-m-d 00:00:00'))->count();
        $donations_total = Donations::count();
        $donations_last_week = Donations::where('created_at', '>=', date('Y-m-d 00:00:00', strtotime('-7 day')))->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime('-7 day')))->count();
        $donations_difference = $donations_today - $donations_last_week;

        $users_today = User::where('created_at', '>=', date('Y-m-d 00:00:00'))->count();
        $users_last_week = User::where('created_at', '>=', date('Y-m-d 00:00:00', strtotime('-7 day')))->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime('-7 day')))->count();
        $users_difference = $users_today - $users_last_week;

        $donations_received_today = Donations::where('created_at', '>=', date('Y-m-d 00:00:00'))->sum('donation_amount');
        $donations_received_last_week = Donations::where('created_at', '>=', date('Y-m-d 00:00:00', strtotime('-7 day')))->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime('-7 day')))->sum('donation_amount');
        $donations_received_difference = $donations_received_today - $donations_received_last_week;

        $procurement_orders_today = Operations::where('created_at', '>=', date('Y-m-d 00:00:00'))->where('status', Operations::$status['PROCUREMENT ORDER INITIATED'])->count();
        $procurement_orders_last_week = Operations::where('created_at', '>=', date('Y-m-d 00:00:00', strtotime('-7 day')))->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime('-7 day')))->where('status', Operations::$status['PROCUREMENT ORDER INITIATED'])->count();
        $procurement_orders_difference = $procurement_orders_today - $procurement_orders_last_week;

        $procurement_orders_unacknowledged = Operations::where('status', Operations::$status['UNACKNOWLEDGED'])->count();

        $donations_pending = Donations::where('donation_status', Donations::$status['PENDING'])->count();

        $donations_received_every_month = array();
        for ($i = 1; $i <= 12; $i++) {
            $donation_for_the_month = Donations::whereYear('created_at', date('Y'))->whereMonth('created_at', $i)->sum('donation_amount');
            $donations_received_every_month[$i] = $donation_for_the_month;
        }

        $orders_per_location = array();
        $locations = Location::all();
        foreach ($locations as $location) {
            $orders_per_location[$location->location_name] = Operations::where('location_id', $location->id)->count();
        }

        $donations_fulfilled_and_without_media = Donations::where('donation_status', Donations::$status['FIELD WORK DONE'])->where('media_count', 0)->count();
        
        return view('admin.dashboard.index', compact('donations_today', 'donations_difference', 'users_today', 'users_difference', 'donations_received_today', 'donations_received_difference', 'procurement_orders_today', 'procurement_orders_difference', 'procurement_orders_unacknowledged', 'donations_pending', 'donations_received_every_month', 'orders_per_location', 'donations_fulfilled_and_without_media'));
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

    public function see_all(){
        return view('admin.notifications.index');
    }
}
