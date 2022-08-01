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

    public $donations;
    public $donations_difference;
    public $users;
    public $users_difference;
    public $amount_received;
    public $amount_received_difference;
    public $procurement_orders;
    public $procurement_orders_difference;
    public $procurement_orders_unacknowledged;
    public $donations_pending;    


    public function index() {        

        $this->getDashboardStats("day");

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
        
        return view('admin.dashboard.index', [
            'donations' => $this->donations,
            'donations_difference' => $this->donations_difference,
            'users' => $this->users,
            'users_difference' => $this->users_difference,
            'amount_received' => $this->amount_received,
            'amount_received_difference' => $this->amount_received_difference,
            'procurement_orders' => $this->procurement_orders,
            'procurement_orders_difference' => $this->procurement_orders_difference,
            'procurement_orders_unacknowledged' => $this->procurement_orders_unacknowledged,
            'donations_pending' => $this->donations_pending,
            'donations_received_every_month' => $donations_received_every_month,
            'orders_per_location' => $orders_per_location,
            'donations_fulfilled_and_without_media' => $donations_fulfilled_and_without_media,
        ]);
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

    private function getStatsForDay(){
            $this->donations = Donations::whereDay('created_at', date('d'))->count();
            $donations_received_previously = Donations::whereDay('created_at', date('d', strtotime('-1 day')))->count();
            $this->donations_difference = $this->donations - $donations_received_previously;

            $this->users = User::whereDay('created_at', date('d'))->count();
            $users_registered_previously = User::whereDay('created_at', date('d', strtotime('-1 day')))->count();
            $this->users_difference = $this->users - $users_registered_previously;

            $this->amount_received = Donations::whereDay('created_at', date('d'))->sum('donation_amount');
            $amount_received_previously = Donations::whereDay('created_at', date('d', strtotime('-1 day')))->sum('donation_amount');
            $this->amount_received_difference = $this->amount_received - $amount_received_previously;

            $this->procurement_orders = Operations::whereDay('created_at', date('d'))->where('status', Operations::$status['PROCUREMENT ORDER INITIATED'])->count();
            $procurement_orders_placed_previously = Operations::whereDay('created_at', date('d', strtotime('-1 day')))->where('status', Operations::$status['PROCUREMENT ORDER INITIATED'])->count();
            $this->procurement_orders_difference = $this->procurement_orders - $procurement_orders_placed_previously;
    }

    private function getStatsForMonth(){
            $this->donations = Donations::whereMonth('created_at', date('m'))->count();
            $donations_received_previously = Donations::whereMonth('created_at', date('m', strtotime('-1 month')))->count();
            $this->donations_difference = $this->donations - $donations_received_previously;

            $this->users = User::whereMonth('created_at', date('m'))->count();
            $users_registered_previously = User::whereMonth('created_at', date('m', strtotime('-1 month')))->count();
            $this->users_difference = $this->users - $users_registered_previously;

            $this->amount_received = Donations::whereMonth('created_at', date('m'))->sum('donation_amount');
            $amount_received_previously = Donations::whereMonth('created_at', date('m', strtotime('-1 month')))->sum('donation_amount');
            $this->amount_received_difference = $this->amount_received - $amount_received_previously;

            $this->procurement_orders = Operations::whereMonth('created_at', date('m'))->where('status', Operations::$status['PROCUREMENT ORDER INITIATED'])->count();
            $procurement_orders_placed_previously = Operations::whereMonth('created_at', date('m', strtotime('-1 month')))->where('status', Operations::$status['PROCUREMENT ORDER INITIATED'])->count();
            $this->procurement_orders_difference = $this->procurement_orders - $procurement_orders_placed_previously;
    }

    private function getStatsForYear(){
            $this->donations = Donations::whereYear('created_at', date('Y'))->count();
            $donations_received_previously = Donations::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
            $this->donations_difference = $this->donations - $donations_received_previously;

            $this->users = User::whereYear('created_at', date('Y'))->count();
            $users_registered_previously = User::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
            $this->users_difference = $this->users - $users_registered_previously;

            $this->amount_received = Donations::whereYear('created_at', date('Y'))->sum('donation_amount');
            $amount_received_previously = Donations::whereYear('created_at', date('Y', strtotime('-1 year')))->sum('donation_amount');
            $this->amount_received_difference = $this->amount_received - $amount_received_previously;

            $this->procurement_orders = Operations::whereYear('created_at', date('Y'))->where('status', Operations::$status['PROCUREMENT ORDER INITIATED'])->count();
            $procurement_orders_placed_previously = Operations::whereYear('created_at', date('Y', strtotime('-1 year')))->where('status', Operations::$status['PROCUREMENT ORDER INITIATED'])->count();
            $this->procurement_orders_difference = $this->procurement_orders - $procurement_orders_placed_previously;
    }

    private function getStatsForWeek(){
            $previous_week = strtotime("-1 week +1 day");
            $start_week = strtotime("this sunday",$previous_week);
            $end_week = strtotime("next saturday",$start_week);
            $start_week = date("Y-m-d 00:00:00",$start_week);
            $end_week = date("Y-m-d 23:59:59",$end_week);            

            $previous_week = strtotime("-2 week +1 day");
            $start_week_previous = strtotime("this sunday",$previous_week);
            $end_week_previous = strtotime("next saturday",$start_week_previous);
            $start_week_previous = date("Y-m-d 00:00:00",$start_week_previous);
            $end_week_previous = date("Y-m-d 23:59:59",$end_week_previous);

            $this->donations = Donations::whereBetween('created_at', [$start_week, $end_week])->count();
            $donations_received_previously = Donations::whereBetween('created_at', [$start_week_previous, $end_week_previous])->count();
            $this->donations_difference = $this->donations - $donations_received_previously;

            $this->users = User::whereBetween('created_at', [$start_week, $end_week])->count();
            $users_registered_previously = User::whereBetween('created_at', [$start_week_previous, $end_week_previous])->count();
            $this->users_difference = $this->users - $users_registered_previously;

            $this->amount_received = Donations::whereBetween('created_at', [$start_week, $end_week])->sum('donation_amount');
            $amount_received_previously = Donations::whereBetween('created_at', [$start_week_previous, $end_week_previous])->sum('donation_amount');
            $this->amount_received_difference = $this->amount_received - $amount_received_previously;

            $this->procurement_orders = Operations::whereBetween('created_at', [$start_week, $end_week])->where('status', Operations::$status['PROCUREMENT ORDER INITIATED'])->count();
            $procurement_orders_placed_previously = Operations::whereBetween('created_at', [$start_week_previous, $end_week_previous])->where('status', Operations::$status['PROCUREMENT ORDER INITIATED'])->count();
            $this->procurement_orders_difference = $this->procurement_orders - $procurement_orders_placed_previously;            
    }

    private function getStatsFromDatabase($duration){
        switch ($duration) {
            case 'day':
                $this->getStatsForDay();
                break;
            case 'month':
                $this->getStatsForMonth();
                break;
            case 'year':
                $this->getStatsForYear();
                break;
            case 'week':
                $this->getStatsForWeek();
                break;
            default:
                $this->getStatsForDay();
                break;
        }        
    }
    
    /**
     * getDashboardStats - Get the dashboard stats
     *
     * @param  mixed $days
     * @return void
     */
    private function getDashboardStats($duration){
        
        $this->getStatsFromDatabase($duration);

        $this->procurement_orders_unacknowledged = Operations::where('status', Operations::$status['UNACKNOWLEDGED'])->count();

        $this->donations_pending = Donations::where('donation_status', Donations::$status['PENDING'])->count();
    }
    
    /**
     * displayStats - Get updated stats for the dashboard.
     *
     * @param  mixed $request
     * @return void
     */
    public function displayStats(Request $request){
        $this->getDashboardStats($request->duration);
        return [
            'donations' => $this->donations,
            'donations_difference' => $this->donations_difference,
            'users' => $this->users,
            'users_difference' => $this->users_difference,
            'amount_received' => $this->amount_received,
            'amount_received_difference' => $this->amount_received_difference,
            'procurement_orders' => $this->procurement_orders,
            'procurement_orders_difference' => $this->procurement_orders_difference,            
        ];
    }
    
}
