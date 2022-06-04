<?php

namespace App\Jobs\Missions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Mission;
use App\Models\User;
use App\Models\MissionAssignment;
use App\Models\Donations;
use App\Models\Operations;

class AddOrUpdateMission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mission)
    {
        $this->mission = $mission;
        //This contains
        //location_id (int location_id)
        //field_manager_id (int user_id)
        //assigned_volunteers (array)
        //execution_date (date)
        //mission_status (int)
        //description (string)
        //procurement_items (array)        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->mission->id == null) {
            $mission = new Mission;
            $mission->location_id = $this->mission->location_id;
            $mission->field_manager_id = $this->mission->field_manager_id;
            $mission->assigned_volunteers = json_encode($this->mission->assigned_volunteers);
            $mission->execution_date = $this->mission->execution_date;
            $mission->mission_status = $this->mission->mission_status;
            $mission->description = $this->mission->description;            
            $mission->procurement_items = json_encode($this->mission->procurement_items);
            $mission->save();
            activity()->log('Added mission with id: #' . $this->mission->id.' by user with id: #'.auth()->user()->id);
            $users = $this->mission->assigned_volunteers;            
            array_push($users, $this->mission->field_manager_id);
            foreach ($users as $user) {
                $missionAssignment = new MissionAssignment;
                $missionAssignment->mission_id = $mission->id;
                $missionAssignment->user_id = $user;
                $missionAssignment->status = 0;
                $missionAssignment->save();
            }

        }
        else {
            $mission = Mission::where('id', $this->mission->id)->first();
            $mission->update([
                'location_id' => $this->mission->location_id,
                'field_manager_id' => $this->mission->field_manager_id,
                'assigned_volunteers' => json_encode($this->mission->assigned_volunteers),
                'execution_date' => $this->mission->execution_date,
                'mission_status' => $this->mission->mission_status,
                'description' => $this->mission->description,
                'procurement_items' => json_encode($this->mission->procurement_items)
            ]);
            activity()->log('Updated mission with id: #' . $this->mission->id.' by user with id: #'.auth()->user()->id);
                    
        }
    }
}
