<?php

namespace App\Jobs\Operations;

use App\Models\Donations;
use App\Models\Operations;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateProcurementListEntries implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $donation;
    public $payment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $operation = new Operations;
        $operation->donation_id = Donations::where('razorpay_payment_id', $this->payment->id)->first()->id;
        $operation->procurement_item = $this->payment->cause;
        $operation->procurement_quantity = $this->payment->quantity;
        $operation->vendor = null; //TODO
        $operation->status = 'UNACKNOWLEDGED';
        $operation->mission_id = null; //TODO
        $operation->last_updated_by = null;
        $operation->save();


        // Adding activity log
        activity()
        ->performedOn($operation)
        ->log('Procurement list updated for Donation # '. $this->payment->id);
    }
}
