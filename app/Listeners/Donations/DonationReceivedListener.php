<?php

namespace App\Listeners\Donations;

use App\Models\User;
use App\Models\Donations;
use App\Models\Operations;
use App\Mail\DonationMail;
use App\Mail\DonationAdminEmail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\Donation\AddOrUpdateUser;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\Donations\DonationReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\Donation\CreateDonationReceipt;
use App\Jobs\Donation\AddOrUpdateDonationEntry;
use App\Jobs\Operations\CreateProcurementListEntries;
use App\Jobs\TestJob;

class DonationReceivedListener implements ShouldQueue
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
        AddOrUpdateDonationEntry::dispatch($payment, $user)->onQueue('default');



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

        TestJob::dispatch();

    }
}
