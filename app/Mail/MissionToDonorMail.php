<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MissionToDonorMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mission, $user_name, $cause)
    {
        $this->mission = $mission;
        $this->user_name = $user_name;
        $this->cause = $cause;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.MissionToDonor', [
            'mission' => $this->mission,
            'user_name' => $this->user_name,
            'cause' => $this->cause,
        ])->subject('Hey! Your donation is on its way!');
    }
}
