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
        $user = auth()->user()->name;
        if ($event->action){
            Donations::create($event->donation);
            activity()->log('Added a new donation (#'.$id.') by '.$user);
        } 
        else{
            Donations::find($id)->update($event->donation); 
            activity()->log('Updated a donation (#'.$id.') by '.$user);
        }

        //1-> add record, 0-> update record
        
    }
}
