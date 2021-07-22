<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserInivitationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $tempuser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tempuser)
    {
        $this->tempuser = $tempuser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Inivitation Mail from feed the poor for registration')->markdown('email.user_inivitation')->with('tempuser', $this->tempuser);
        
        return $this;
    }
}
