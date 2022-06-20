<?php

namespace App\Jobs\Operations;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\OperationsUpdate;
use Illuminate\Support\Facades\Mail;

class OperationsUpdateMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $operation;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($operation)
    {
        $this->operation = $operation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $operation = $this->operation;
        $donation = Donations::find($operation->donation_id);
        $donor = User::find($donation->donor_id);
        $email = $donor->email;
        Mail::to($email)->send(new OperationsUpdate($operation, $donor));
    }
}
