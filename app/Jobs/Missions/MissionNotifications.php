<?php

namespace App\Jobs\Missions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Donations;
use App\Models\Operations;
use App\Models\Mission;
use App\Models\User;

use App\Mail\MissionCreateOrUpdateMail;
use App\Mail\MissionToDonorMail;
use App\Mail\VolunteerAcceptMail;
use App\Mail\FieldManagerAcceptMail;
use Illuminate\Support\Facades\Mail;

class MissionNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $mission;
    public $create;
    public $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mission, $create, $message)
    {
        $this->mission = $mission;
        $this->message = $message;
        $this->create = $create;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $create = $this->create;
        $mission = $this->mission;
        $message = $this->message;

        if ($create) {
            //Sending necessary notifications upon mission creation
            $donors = array();
            $procurment_items = $mission->procurment_items;
            foreach ($procurment_items as $item) {
                $proc = Operations::where('id', $item)->first();
                $donation = Donations::where('id', $proc->donation_id)->first();
                $donor = User::where('id', $donation->donor_id)->first();
                array_push($donors, [$donor->email, $proc->procurement_item, $donor->name]);                
            }
            foreach ($donors as $donor) {
                Mail::to($donor[0])->send(new MissionToDonorMail($mission, $donor[2], $donor[1]));
                //Send mission details to donor
            }

            $field_manager = User::where('id', $mission->field_manager_id)->first();
            Mail::to($field_manager->email)->send(new FieldManagerAcceptMail($mission, $field_manager->name, $field_manager->id));
            //Send mission accept mail to field manager

            $volunteers = $mission->assigned_volunteers;
            foreach ($volunteers as $volunteer) {
                $vol = User::where('id', $volunteer)->first();
                Mail::to($vol->email)->send(new VolunteerAcceptMail($mission, $vol->name, $vol->id));
                //Send mission accept mail to volunteer
            }

        }
        else {

            //Send mission update mail to all concerned parties
            $recipients = array();
            array_push($recipients, User::where('id', $mission->field_manager_id)->first()->email);
            foreach($mission->assigned_volunteers as $id){
                array_push($recipients, User::where('id', $id)->first()->email);
            }
            foreach($recipients as $recipient){
                Mail::to($recipient)->send(new MissionCreateOrUpdateMail($mission, $message));
                //Send mission updated email
            }
            foreach($mission->procurment_items as $item){
                $proc = Operations::where('id', $item)->first();
                $donation = Donations::where('id', $proc->donation_id)->first();
                $donor = User::where('id', $donation->donor_id)->first();
                Mail::to($donor->email)->send(new MissionCreateOrUpdateMail($mission, $message));
                //Send mission updated email to donor
            }

        }
    }
}
