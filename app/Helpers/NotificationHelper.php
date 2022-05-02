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
     *
     * IMPORTNAT! READ THIS BEFORE YOU USE NOTIFICAITONS.
     *
     * This is a simple way to notify the
     * users of our application.
     *
     * You can simply do this.
     *
     * app(NotificationHelper::class)->user(auth()->user())->content('Title', 'Body')->notify();
     *
     *
     * @author(s) Dinesh Kumar, Leonard Selvaraja
     * 3 MAY 2022
     */

    # Setting up defaults for all the public vars we're going to use.
    public $user = null;
    public $title = null;
    public $body = null;
    public $action = '#';
    public $type = null;
    public $icon = 'bell';
    public $color = 'dark';

    /**
     * action - "click" behaviour for the notification.
     * By default, it's "#", which does not do anything.
     *
     * @param  mixed $action
     * @return object
     */
    public function action($action) {
        $this->action = $action;
        return $this;
    }

    /**
     * type -
     *
     * @param  mixed $type
     * @return object
     */
    public function type($type){

        # If the notification type is NULL,
        # Then it's assumed it's a app notification.
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
    public function icon($icon){
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
            }
        } else {

            # User has been passed.
            $this->user = $users;
        }


        return $this;
    }



    /**
     * validations - Just to make sure all the "required"
     * values are instantiatied and filled up.
     *
     * @return void
     */
    protected function validations() {

        if($this->title == null) {
            throw new Exception('Notification Helper Error: title cannot be blank.');
        }

        if($this->body == null) {
            throw new Exception('Notification Helper Error: body cannot be blank.');
        }

        # Notification user
        if($this->user == null) {
            if(Auth::check()) {
                $this->user = auth()->user();
            } else {
                throw new Exception('Notification Helper Error: No ID / Array passed in user() method. Whom exactly do you want to notify bestie?');
            }
        }
        # Notification type.
        if($this->type == null) {
            $this->type = Notification::$types['APP'];
        }
    }


    /**
     * notify - This is where everything comes alive.
     *
     * @return object
     */
    public function notify() {


        # just making sure all the required values are filled in.
        $this->validations();

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
