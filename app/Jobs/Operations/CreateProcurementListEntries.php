<?php

namespace App\Jobs\Operations;

use App\Models\Location;
use App\Models\Donations;
use App\Models\Operations;
use Illuminate\Bus\Queueable;
use App\Helpers\NotificationHelper;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class CreateProcurementListEntries implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, IsMonitored, SerializesModels;

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
        $operation->location_id = 0;
        $operation->procurement_item = isset($this->payment->cause) ? $this->payment->cause : $this->payment->campaign;
        $operation->procurement_quantity = isset($this->payment->cause) ? $this->payment->quantity : 1;
        $operation->vendor = null; //TODO
        $operation->status = Operations::$status['UNACKNOWLEDGED'];
        $operation->mission_id = null; //TODO
        $operation->last_updated_by = null;
        $operation->save();



        $admins = NotificationHelper::getAllAdmins();
        foreach($admins as $admin) {
            app(NotificationHelper::class)->user($admin)
            ->icon('briefcase')
            ->color('success')
            ->action(route('admin.operations.procurement.index'))
            ->content(
                '[Operations] Procurement list updated - (donation #'. $operation->donation_id .')',
                'Item: ' . $operation->procurement_item .', Quantity: '. $operation->procurement_quantity . '. Kindly initiate procurement order for this donation. ',
            )->notify();
        }

        // Adding activity log
        activity()
        ->performedOn($operation)
        ->log('Procurement list updated for Donation # '. $this->payment->id);
    }
}
