<?php

namespace App\Listeners\Donations;

use App\Models\User;
use App\Mail\DonationMail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\Donation\AddOrUpdateUser;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\Donations\DonationReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\Donation\CreateDonationReceipt;
use romanzipp\QueueMonitor\Traits\IsMonitored;
use App\Jobs\Donation\AddOrUpdateDonationEntry;
use App\Jobs\Operations\CreateProcurementListEntries;

class DonationReceivedListener implements ShouldQueue
{
    use IsMonitored;

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
     * @param  \App\Events\DonationReceived  $event
     * @return void
     */
    public function handle(DonationReceived $event)
    {

        $payment = $event->details;

        # Add or update user, if new user, this JOB will dispatched a welcome email job as well.
        # THIS SHOULD BE DONE ASYNCRONOUSLY, NOT QUEUED.

        AddOrUpdateUser::dispatch([
            'name' => $payment->name,
            'email' => $payment->email,
            'phone_number' => $payment->phone,
            'pan_number' => (isset($payment->pan)) ? $payment->pan : null,
            'address' => (isset($payment->address)) ? $payment->address : null,
            'account_claimed' => false,
        ])->onQueue('default');

        # Add donation entry
        $user = User::where('email', $payment->email)->first();

        $cause = isset($payment->cause) ? Causes::where('name', $payment->cause)->first() : 0;
        $campaign = isset($payment->campaign) ? Campaigns::where('campaign_name', $payment->campaign)->first() : 0;

        # Check if there is a donation with the same ID.
        if(Donations::where('razorpay_payment_id', $payment->id)->count() == 0) {
            $donation = new Donations;
            $donation->donor_id = $user->id;
            $donation->donor_name = $user->name;
            $donation->donation_amount = $payment->amount;
            $donation->donation_in_words = $payment->amt_in_words;


            # If payment arrives through a campaign...
            if (isset($payment->campaign)){
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
            $donation->razorpay_payment_id = $payment->id;
            $donation->save();

            # Normal donations were failing because of this.
            // $campaign_name = isset($payment->campaign) ? ', Campaign # (?) '.$campaign->campaign_name : '. (NO CAMPAIGN)';
            // $addl = ' for Cause # '. $campaign_name;

            $admins = NotificationHelper::getAllAdmins();
            foreach($admins as $admin) {
                app(NotificationHelper::class)->user($admin)
                ->icon('dollar-sign')
                ->color('success')
                ->action(route('admin.donations.manage', $donation->id))
                ->content(
                    'New donation received',
                    '₹'.$payment->amount.' received from '. $user->name.' (user #'.$user->id.'), for cause: '.$cause->name,
                )->notify();
            }

            # This is for the frontend-tracking page.
            $log = 'A donation entry created for ₹'.$payment->amount.', received from '. $user->name.' (user #'.$user->id.'), for cause: '.$cause->name;
            DonationsHelper::addDonationActivity($donation, $log);

            activity()->log('New donation of ₹'.$payment->amount.' received from '. $user->name.' (#'.$user->id.')');
        } else {

            $admins = NotificationHelper::getAllAdmins();
            foreach($admins as $admin) {
                app(NotificationHelper::class)->user($admin)
                ->icon('money-bill')
                ->color('success')
                ->content(
                    '[Duplicate entry] New donation received',
                    '₹'.$payment->amount.' received from '. $user->name.' (#'.$user->id.')',
                )->notify();
            }

            activity()->log('[Duplicate entry] Donation of ₹'.$payment->amount.' received from '. $user->name.' (#'.$user->id.') for '. isset($payment->campaign) ? 'campaign '.$campaign->campaign_name : 'cause '.$cause->name);
        }
        //AddOrUpdateDonationEntry::dispatch($payment, $user)->onQueue('default');



        # Generate Donation receipt
        // CreateDonationReceipt::dispatch(['payment' => $payment, 'user' => $user])->onQueue('default');

        /*since we have a seperate route to display the receipt generated on the fly (/donation/receipt/{id}),
        we can use that instead of this.

        - Anirudh
        08/4/2022

        This is good! But it defeats the purpose of the admins getting the receipt.
        After donating, we're directing them to their email, but in that e-mail we're
        again directing them towards the website? We would have come full circle then haha.

        Plus, the emails are designed only to handle PDFs as attachments.

        This is a great fallback method we can rely upon. But as of now, let it remain as it
        is.

        - leonard,
        16/4/2022.


        Soooooo, the PDF Jobs were failing on PROD! FML.
        Good thing that Anirudh actually created a way for us to revert
        back to stream PDFs from browser.

        - Leonard
        23/4/2022.
        */


        # Email admins
        //TODO find out a way to e-mail / dispatch a notiffication to all users / admins
        //Mail::to('kashrayks@gmail.com')->send(new DonationAdminEmail($event->details));

        # Email donor about confirmation
        Mail::to($event->details['email'])->send(new DonationMail($event->details));


        # Add "Operations" logic TODO
        CreateProcurementListEntries::dispatch($payment);



    }
}
