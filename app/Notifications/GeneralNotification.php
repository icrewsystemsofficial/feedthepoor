<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GeneralNotification extends Notification
{
    use Queueable;


    public $type;
    public $title;
    public $body;
    public $action;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
   public function __construct($body, $title = 'NO_TITLE', $action = '#', $type = '0', $icon = 'bell', $color = 'dark')
   {

        $this->type = $type;
        $this->title = $title;
        $this->body = $body;
        $this->action = $action;
        $this->icon = $icon;
        $this->color = $color;
   }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
   public function via($notifiable)
   {
      if($this->type == 0) {
        return ['database'];
      } else if($this->type == 1) {
        return ['mail'];
      } else if($this->type == 2) {
        return  ['mail', 'database'];
      }
   }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
   public function toMail($notifiable)
   {
     if($this->title == 'NO_TITLE') {
       $title = 'There is a new notification for you';
     } else {
       $title = $this->title;
     }

     if($this->action == '#') {
       $action = '#';
     } else {
       $action = $this->action;
     }


     return (new MailMessage)
               ->subject('['.config('app.name').' Notification] '.$title.'')
               ->greeting('Hey there!')
               ->line('You have a new notification Feed The Poor')
               ->line($this->body)
               ->action('Take a look', url($action))
               ->line('This is an auto-generated email.');
   }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
      return [
        'title' => $this->title,
        'body' => $this->body,
        'action' => $this->action,
        'color' => $this->color,
        'icon' => $this->icon,
      ];
    }
}
