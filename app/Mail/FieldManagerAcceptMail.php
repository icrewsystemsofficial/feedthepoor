<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FieldManagerAcceptMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mission, $user_name, $user_id)
    {
        $this->mission = $mission;
        $this->user_name = $user_name;
        $this->user_id = $user_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.FieldManagerAccept', [
            'mission' => $this->mission,
            'user_name' => $this->user_name,
            'user_id' => $this->user_id,
        ])->subject('Your mission should you choose to accept it!');
    }
}
