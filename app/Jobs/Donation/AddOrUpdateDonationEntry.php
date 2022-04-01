<?php

namespace App\Jobs\Donation;

use App\Models\Causes;
use App\Models\User;
use App\Models\Donations;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class AddOrUpdateDonationEntry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $payment;
    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($payment, User $user)
    {
        $this->payment = $payment;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $cause = Causes::where('name', $this->payment->cause)->first();

        # Check if there is a donation with the same ID.
        if(Donations::where('razorpay_payment_id', $this->payment->id)->count() == 0) {
            $donation = new Donations;
            $donation->donor_id = $this->user->id;
            $donation->donor_name = $this->user->name;
            $donation->donation_amount = $this->payment->amount;
            $donation->donation_in_words = $this->payment->amt_in_words;
            $donation->cause_id = $cause->id;
            $donation->cause_name = $cause->name;
            $donation->donation_status = Donations::$status['VERIFIED'];
            $donation->payment_method = Donations::$payment_methods['RAZORPAY'];
            $donation->razorpay_payment_id = $this->payment->id;
            $donation->save();

            activity()->log('New donation of ₹'.$this->payment->amount.' received from '. $this->user->name.' (#'.$this->user->id.') for '. $cause->name);
        } else {
            activity()->log('[Duplicate entry] Donation of ₹'.$this->payment->amount.' received from '. $this->user->name.' (#'.$this->user->id.') for '. $cause->name);
        }

    }
}
