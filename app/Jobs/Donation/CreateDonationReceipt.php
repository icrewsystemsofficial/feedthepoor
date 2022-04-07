<?php

namespace App\Jobs\Donation;

use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use romanzipp\QueueMonitor\Traits\IsMonitored;
use App\Models\Donations;

class CreateDonationReceipt implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;
    public $payment;
    public $user;
    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {

        $data = (object) $data;

        $this->user = $data->user;
        $this->payment = $data->payment;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //$file_name = 'donation_receipt_'. $this->payment->id;

        $pdf = PDF::loadView('pdf.receipts.receipt', ['data' => $this->data])
            ->setPaper('a4', 'portrait');
        
        return $pdf->output();
    }
}
