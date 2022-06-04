<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class NewDonorWelcomeEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels, IsMonitored;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newDonor', [
            'user' => $this->user,
        ])->subject('Hey '.$this->user->name.', welcome to '.config('app.ngo_name').'');
    }
}
