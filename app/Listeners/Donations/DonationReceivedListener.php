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

        # Add or update user, if new user, this job will dispatch a welcome email job as well.
        AddOrUpdateUser::dispatch([
            'name' => $payment->name,
            'email' => $payment->email,
            'phone_number' => $payment->phone,
            'pan_number' => (isset($payment->pan)) ? $payment->pan : null,
            'account_claimed' => false,
        ]);

        # Add donation entry
        $user = User::where('email', $payment->email)->first();
        AddOrUpdateDonationEntry::dispatch($payment, $user);


        # Generate Donation receipt
        CreateDonationReceipt::dispatch([
            'payment' => $payment,
            'user' => $user,
        ]);


        # Email admins
        Mail::to('kashrayks@gmail.com')->send(new DonationAdminEmail($event->details));

        # Email donor about confirmation
        Mail::to($event->details['email'])->send(new DonationMail($event->details));


        # Add "Operations" logic TODO
        $operation = new Operations;
        $operation->donation_id = Donations::where('razorpay_payment_id', $payment->id)->first()->id;
        $operation->procurement_item = $payment->cause;
        $operation->procurement_quantity = $payment->quantity;
        $operation->vendor = null; //TODO
        $operation->status = 'UNACKNOWLEDGED';
        $operation->mission_id = null; //TODO
        $operation->last_updated_by = $user->id;
        $operation->save();


    }
}
