<?php

namespace App\Jobs\Missions;

use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Operations;
use App\Models\Donations;
use App\Mail\ProcurementListMail;

class ProcurementList implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($procurement_items, $field_manager)
    {
        $this->procurement_items = $procurement_items;
        $this->field_manager = $field_manager;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $donations = [];
        $procurement_list = [1,2,3];
        $field_manager = User::find(5);
        foreach ($procurement_list as $id) {
            $operation = Operations::find($id);
            $donation = Donations::find($operation->donation_id);
            $donations[] = [$donation->donor_name, $donation->created_at, $id, $operation->procurement_quantity];
        }         
        $pdf = PDF::loadView('pdf.missions.ProcurementList', ['data' => [
            'donations' => $donations,
        ]])->setPaper('a4', 'portrait')->setOptions([
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
        ]);
        $output = $pdf->output();
        Mail::to($field_manager->email)->send(new ProcurementListMail($output, $field_manager->name ));        
    }
}
