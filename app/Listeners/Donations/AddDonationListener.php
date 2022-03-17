<?php

namespace App\Listeners\Donations;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Donations;
use App\Events\Donations\AddDonation;

class AddDonationListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(AddDonation $event)
    {   
        $id = $event->id;
        ($event->action) ? Donations::create($event->donation) : Donations::find($id)->update($event->donation); 

        //1-> add record, 0-> update record
        
    }
}
