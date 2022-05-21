<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MissionCreateOrUpdate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mission, $message = '', $user_name = '')
    {
        $this->mission = $mission;
        $this->message = $message;
        $this->user_name = $user_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.CreateOrUpdateMission', [
            'mission' => $this->mission,
            'message' => $this->message,
            'user_name' => $this->user_name,
        ])->subject('Hey! A new mission has been created or updated!');
    }
}
