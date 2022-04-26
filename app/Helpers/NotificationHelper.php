<?php
namespace App\Helpers;

use App\Models\User;
use App\Notifications\GeneralNotification;
use Exception;
use Illuminate\Support\Facades\Auth;

class NotificationHelper {

    /**
     * all_statuses - Retrives all the status from the moodel.
     *
     * @return array
     */
    public $user;
    public $title;
    public $body;
    public $action = '#';
    public $type = 0;
    public $icon;
    public $color;

    public function action($action){
        $this->action = $action;
        return $this;
    }

    public function tyoe($tyoe){
        $this->tyoe = $tyoe;
        return $this;
    }

    public function icon($icon){
        $this->icon = $icon;
        return $this;
    }

    public function color($color){
        $this->color = $color;
        return $this;
    }

    public function content($title, $body){
        $this->title = $title;
        $this->body = $body;
        return $this;
    }

    public function user($users){
        $this->user = $users;
        return $this;
    }

    public function notify(){
        $this->user->notify(new GeneralNotification(
            $body = $this->body,
            $title = $this->title,
            $action = $this->action,
            $type = $this->type,
            $icon = $this->icon,
            $color = $this->color
            )
        );
        return $this;
    }

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
