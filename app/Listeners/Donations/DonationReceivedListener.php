<?php

namespace App\Listeners\Donations;

use App\Events\Donations\DonationReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationMail;

class DonationReceivedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\DonationReceived  $event
     * @return void
     */
    public function handle(DonationReceived $event)
    {        
        Mail::to($event->details['email'])->send(new DonationMail($event->details));
    }
}
