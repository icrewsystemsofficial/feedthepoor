<?php

namespace App\Jobs\Donation;

use App\Helpers\NotificationHelper;
use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Mail\NewDonorWelcomeEmail;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class AddOrUpdateUser
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;

    public $name;
    public $email;
    public $phone_number;
    public $pan_number;
    public $account_claimed;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        $array
    )
    {
        $this->name = $array['name'];
        $this->email = $array['email'];
        $this->phone_number = $array['phone_number'];
        $this->pan_number = $array['pan_number'];
        $this->account_claimed = $array['account_claimed'];
        $this->address = $array['address'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        # Check if a user with similar e-mail ID exists.
        $user = User::where('email', $this->email)->count();
        if($user == 0) {
            $user = new User;
            $user->name = $this->name;
            $user->email = $this->email;
            $user->phone_number = $this->phone_number;
            $user->pan_number = $this->pan_number;
            $user->account_claimed = $this->account_claimed;
            $user->address = $this->address;
            $user->save();

            Mail::to($this->email)->send(new NewDonorWelcomeEmail($user));


            // Assign the user the role of donor, since this is triggered by a donation
            // event.

            $user->assignRole('donor');

            $admins = NotificationHelper::getAllAdmins();
            foreach($admins as $admin) {
                app(NotificationHelper::class)->user($admin)
                ->icon('user-plus')
                ->color('success')
                ->action(route('admin.users.manage', $user->id))
                ->content(
                    'New donor account',
                    'A new donor ' . $user->name . ' ('.$user->email.') has been created. ',
                )->notify();
            }

            return $user->id;
        }

        $user = User::where('email', $this->email)->first();
        return $user->id;
    }
}
