<?php
namespace App\Helpers;

use App\Models\User;
use App\Notifications\GeneralNotification;
use Exception;

class NotificationHelper {

    /**
     * all_statuses - Retrives all the status from the moodel.
     *
     * @return array
     */
    // public $users;
    // public $title;
    // public $body;

    // public function content($title, $body){
    //     $this->title = $title;
    //     $this->body = $body;
    //     return $this;
    // }

    // public function users($users){
    //     $this->users = $users;
    //     return $this;
    // }

    // public function notify(){
    //     $this->users->notify(new GeneralNotification(
    //         $body = 'VOMM - Airport has been updated',
    //         $title = 'Flight Operations',
    //         $action = 'occ/admin/flightops/airports',
    //         $type = '0',
    //         $icon = 'shield',
    //         $color = 'warning')
    //     );
    // }

    public static function getNotifications($howmany = '10') {
        return User::find(auth()->user()->id)
                ->notifications()
                ->limit($howmany)
                ->get();
    }

    public static function getUnreadCount() {
        return count(auth()->user()->unreadNotifications);
    }

}
