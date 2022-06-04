<?php

namespace App\Jobs\Donation;

use App\Models\User;
use App\Models\Causes;
use App\Models\Campaigns;
use App\Models\Donations;
use Illuminate\Bus\Queueable;
use App\Helpers\NotificationHelper;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class AddOrUpdateDonationEntry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;

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
        $cause = isset($this->payment->cause) ? Causes::where('name', $this->payment->cause)->first() : 0;
        $campaign = isset($this->payment->campaign) ? Campaigns::where('campaign_name', $this->payment->campaign)->first() : 0;

        # Check if there is a donation with the same ID.
        if(Donations::where('razorpay_payment_id', $this->payment->id)->count() == 0) {
            $donation = new Donations;
            $donation->donor_id = $this->user->id;
            $donation->donor_name = $this->user->name;
            $donation->donation_amount = $this->payment->amount;
            $donation->donation_in_words = $this->payment->amt_in_words;


            # If payment arrives through a campaign...
            if (isset($this->payment->campaign)){
                $donation->campaign_id = $campaign->id;
                $donation->cause_id = null;
                $donation->cause_name = null;
            }
            else {
                $donation->cause_id = $cause->id;
                $donation->cause_name = $cause->name;
                $donation->campaign_id = null;
            }
            $donation->donation_status = Donations::$status['PENDING'];
            $donation->payment_method = Donations::$payment_methods['RAZORPAY'];
            $donation->razorpay_payment_id = $this->payment->id;
            $donation->save();

            # Normal donations were failing because of this.
            // $campaign_name = isset($this->payment->campaign) ? ', Campaign # (?) '.$campaign->campaign_name : '. (NO CAMPAIGN)';
            // $addl = ' for Cause # '. $campaign_name;

            $admins = NotificationHelper::getAllAdmins();
            foreach($admins as $admin) {
                app(NotificationHelper::class)->user($admin)
                ->icon('dollar-sign')
                ->color('success')
                ->action(route('admin.donations.manage', $donation->id))
                ->content(
                    'New donation received',
                    '₹'.$this->payment->amount.' received from '. $this->user->name.' (user #'.$this->user->id.'), for cause: '.$cause->name,
                )->notify();
            }

            activity()->log('New donation of ₹'.$this->payment->amount.' received from '. $this->user->name.' (#'.$this->user->id.')');
        } else {

            $admins = NotificationHelper::getAllAdmins();
            foreach($admins as $admin) {
                app(NotificationHelper::class)->user($admin)
                ->icon('money-bill')
                ->color('success')
                ->content(
                    '[Duplicate entry] New donation received',
                    '₹'.$this->payment->amount.' received from '. $this->user->name.' (#'.$this->user->id.')',
                )->notify();
            }

            activity()->log('[Duplicate entry] Donation of ₹'.$this->payment->amount.' received from '. $this->user->name.' (#'.$this->user->id.') for '. isset($this->payment->campaign) ? 'campaign '.$campaign->campaign_name : 'cause '.$cause->name);
        }

    }


}
