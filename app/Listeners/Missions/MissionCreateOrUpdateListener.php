<?php

namespace App\Listeners\Missions;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\Missions\AddOrUpdateMission;
use App\Jobs\Missions\ProcurementList;
use App\Jobs\Missions\MissionNotifications;
use App\Events\Missions\MissionCreateOrUpdate;
use App\Models\Missions;
use App\Models\User;
use App\Models\Operations;
use App\Models\Donations;

class MissionCreateOrUpdateListener
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
    public function handle(MissionCreateOrUpdate $event)
    {
        $mission = $event->mission;
        $message = $event->create ? 'A new mission has been created !!' : 'A mission has been updated !!';
        
        AddOrUpdateMission::dispatch($mission, $message)->delay(now());
        //Creates or updates the mission and sends an email to the field manager, donors and the assigned volunteers

        MissionNotifications::dispatch($mission, $event->create, $message)->delay(now());
        //Sends notifications to the donors, field managers and volunteers

        
        if ($event->create) {            
            ProcurmentList::dispatch($procurment_items, $field_manager)->delay(strtotime($mission->execution_date));
            //Schedule procurement list pdf email to field manager
        }

    }
}
