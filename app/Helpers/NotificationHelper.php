<?php
namespace App\Helpers;

use App\Models\Notification;
use App\Models\User;
use App\Notifications\GeneralNotification;
use Exception;
use Illuminate\Support\Collection;
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
    public $action;
    public $type;
    public $icon;
    public $color;

    /**
     * action - "click" behaviour for the notification.
     * By default, it's "#", which does not do anything.
     *
     * @param  mixed $action
     * @return object
     */
    public function action($action = '#') {
        $this->action = $action;
        return $this;
    }

    /**
     * type -
     *
     * @param  mixed $type
     * @return object
     */
    public function type($type = null){

        # If the notification type is NULL,
        # Then it's assumed it's a app notification.
        if($type == null) {
            $type = Notification::$types['APP'];
        }

        $this->type = $type;
        return $this;
    }

    /**
     * icon - we use fontawesome for notifications.
     * If no icon is passed, then we assume it's
     * a "bell" icon.
     *
     * @param  mixed $icon
     * @return object
     */
    public function icon($icon = 'bell'){
        $this->icon = $icon;
        return $this;
    }

    /**
     * color - The color of the notification
     * icon.
     *
     * @param  mixed $color
     * @return object
     */
    public function color($color = 'success'){
        $this->color = $color;
        return $this;
    }

    /**
     * content - The content of the notification.
     *
     * @param  mixed $title
     * @param  mixed $body
     * @return object
     */
    public function content(string $title, string $body){
        $this->title = $title;
        $this->body = $body;
        return $this;
    }

    /**
     * user - whom exactly are we notifying?
     * Can accept an integer or an object.
     * If notifying a single user, pass an integer,
     * if notifying multiple users, pass an object / array.
     *
     * @param  mixed $users
     * @return object
     */
    public function user($users) {

        # If no user is passed, then assume logged in user.
        if(empty($users)) {
            if(Auth::check()) {
                $users = auth()->user();
            } else {
                throw new Exception('Notification Helper Error: No User ID passed');
            }
        } else {

            # User has been passed.
            $this->user = $users;
        }


        return $this;
    }


    /**
     * notify - This is where everything comes alive.
     *
     * @return object
     */
    public function notify() {

        # If the $this->user variable is a collection or an array.
        if($this->user instanceof Collection || is_array($this->user)) {
            foreach($this->user as $user) {
                # Does user exist?
                $getUser = User::where('id', $user)->exists();
                if($getUser == true) {
                    $user_object = User::find($user);
                    $user_object->notify(new GeneralNotification(
                        $body = $this->body,
                        $title = $this->title,
                        $action = $this->action,
                        $type = $this->type,
                        $icon = $this->icon,
                        $color = $this->color
                        )
                    );
                } else {
                    throw new Exception('Notification Helper Error: User with ID '. $user.' not found');
                }
            }
        } else {
            $this->user->notify(new GeneralNotification(
                $body = $this->body,
                $title = $this->title,
                $action = $this->action,
                $type = $this->type,
                $icon = $this->icon,
                $color = $this->color
                )
            );
        }


        return $this;
    }

    /**
     * getNotifications
     *
     * @param  mixed $howmany
     * @return object
     */
    public static function getNotifications($howmany = '10') {
        return User::find(auth()->user()->id)
                ->notifications()
                ->limit($howmany)
                ->get();
    }

    /**
     * getUnreadCount
     *
     * @return object
     */
    public static function getUnreadCount() {
        return count(auth()->user()->unreadNotifications);
    }

}
