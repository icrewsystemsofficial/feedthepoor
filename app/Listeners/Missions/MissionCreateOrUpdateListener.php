<?php

namespace App\Listeners\Missions;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\Missions\AddOrUpdateMission;
use App\Jobs\Missions\ProcurementList;
use App\Jobs\Missions\MissionNotifications;
use App\Events\Missions\MissionCreateOrUpdate;
use App\Models\Mission;
use App\Models\User;
use App\Models\Operations;
use App\Models\Donations;
use App\Models\MissionAssignment;

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
        $mission_data = $event->mission;
        $message = $event->create ? 'A new mission has been created !!' : 'A mission has been updated !!';
        
        //AddOrUpdateMission::dispatch($mission, $message)->delay(now());
        //Creates or updates the mission

        //writing CRUD operations here since it is too short for it to be in a separate job
        if ($event->create) {
            foreach($mission_data->procurment_items as $item) {
                $proc = Operations::where('id', $item)->first();
                $proc->status = 5;
                $proc->save();
            }
            $mission = new Mission;
            $mission->location_id = $mission_data->location_id;
            $mission->field_manager_id = $mission_data->field_manager_id;
            $mission->assigned_volunteers = json_encode($mission_data->assigned_volunteers);
            $mission->execution_date = $mission_data->execution_date;
            $mission->mission_status = $mission_data->mission_status;
            $mission->description = $mission_data->description;            
            $mission->procurement_items = json_encode($mission_data->procurement_items);
            $mission->save();
            activity()->log('Added mission with id: #' . $mission->id.' by user with id: #'.auth()->user()->id);
            $users = $mission_data->assigned_volunteers;            
            array_push($users, $mission_data->field_manager_id);
            foreach ($users as $user) {
                $missionAssignment = new MissionAssignment;
                $missionAssignment->mission_id = $mission->id;
                $missionAssignment->user_id = $user;
                $missionAssignment->status = 0;
                $missionAssignment->save();
            }

        }
        else {
            $mission = Mission::where('id', $mission_data->id)->first();
            if ($mission_data->procurement_items != json_decode($mission->procurement_items)) {
                foreach($mission_data->procurment_items as $item) {
                    $proc = Operations::where('id', $item)->first();
                    $proc->status = 5;
                    $proc->save();
                }                
            }
            $mission->update([
                'location_id' => $mission_data->location_id,
                'field_manager_id' => $mission_data->field_manager_id,
                'assigned_volunteers' => json_encode($mission_data->assigned_volunteers),
                'execution_date' => $mission_data->execution_date,
                'mission_status' => $mission_data->mission_status,
                'description' => $mission_data->description,
                'procurement_items' => json_encode($mission_data->procurement_items)
            ]);
            if ($mission->mission_status == 3) {
                foreach($mission_data->procurment_items as $item) {
                    $proc = Operations::where('id', $item)->first();
                    $proc->status = 6;
                    $proc->save();
                }
            }
            activity()->log('Updated mission with id: #' . $mission->id.' by user with id: #'.auth()->user()->id);
                    
        }

        MissionNotifications::dispatch($mission_data, $event->create, $message)->delay(now());
        //Sends notifications to the donors, field managers and volunteers

        
        if ($event->create) {            
            ProcurementList::dispatch($mission_data->procurment_items, $mission_data->field_manager_id)->delay(strtotime($mission_data->execution_date));
            //Schedule procurement list pdf email to field manager
        }

    }
}
