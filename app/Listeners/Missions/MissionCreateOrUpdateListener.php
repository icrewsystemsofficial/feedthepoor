<?php

namespace App\Listeners\Missions;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\Missions\AddOrUpdateMission;
use App\Jobs\Missions\ProcurementListPdf;
use App\Events\Missions\MissionCreateOrUpdate;
use App\Mail\MissionCreateOrUpdateMail;
use App\Mail\MissionToDonorMail;
use App\Mail\VolunteerAcceptMail;
use App\Mail\FieldManagerAcceptMail;
use App\Models\Missions;
use App\Models\User;
use App\Models\Operations;

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
                
        AddOrUpdateMission::dispatch($mission)->onQueue('default');
        //Creates or updates the mission

        
        if ($event->create) {
            //Sending necessary notifications upon mission creation
            $donors = array();
            $procurment_items = json_decode($mission->procurment_items);
            foreach ($procurment_items as $item) {
                $proc = Operations::where('id', $item->id)->first();
                $donation = Donations::where('id', $proc->donation_id)->first();
                $donor = User::where('id', $donation->donor_id)->first();
                array_push($donors, [$donor->email, $proc->procurement_item, $donor->name]);                
            }
            foreach ($donors as $donor) {
                Mail::to($donor[0])->send(new MissionToDonorMail($mission, $donor[3], $donor[1]));
                //Send mission details to donor
            }

            $field_manager = User::where('id', $mission->field_manager_id)->first();
            Mail::to($field_manager->email)->send(new FieldManagerAcceptMail($mission, $field_manager->name, $field_manager->id));
            //Send mission accept mail to field manager

            $volunteers = json_decode($mission->assigned_volunteers);
            foreach ($volunteers as $volunteer) {
                $vol = User::where('id', $volunteer->id)->first();
                Mail::to($vol->email)->send(new VolunteerAcceptMail($mission, $vol->name, $vol->id));
                //Send mission accept mail to volunteer
            }

            ProcurmentList::dispatch($procurment_items, $field_manager)->delay(strtotime($mission->execution_date));
            //Schedule procurement list pdf email to field manager

        }
        else{
            //Send mission update mail to all concerned parties
            $recipients = array();
            array_push($recipients, User::where('id', $mission->field_manager_id)->first()->email);
            foreach(json_decode($mission->assigned_volunteers) as $id){
                array_push($recipients, User::where('id', $id)->first()->email);
            }
            foreach($recipients as $recipient){
                Mail::to($recipient)->send(new MissionCreateOrUpdateMail($mission, $message));//Send mission updated email
            }
            foreach(json_decode($mission->procurment_items) as $item){
                $proc = Operations::where('id', $item)->first();
                $donation = Donations::where('id', $proc->donation_id)->first();
                $donor = User::where('id', $donation->donor_id)->first();
                Mail::to($donor->email)->send(new MissionCreateOrUpdateMail($mission, $message));//Send mission updated email to donor
            }
        }        

    }
}
