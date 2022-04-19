<?php

namespace App\Mail;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class DonationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels, IsMonitored;

    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details = [])
    {
        $this->details = $details;
    }

    /**
     * get_receipt_pdf
     *
     * @param  mixed $payment_id
     * @return void
     */
    public function get_receipt_pdf($payment_id) {

        $file_name = 'donation_receipt_'. $payment_id;
        // return storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'receipts' . DIRECTORY_SEPARATOR . $file_name . '.pdf');

        if(file_exists(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'receipts' . DIRECTORY_SEPARATOR . $file_name . '.pdf'))) {
            return storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'receipts' . DIRECTORY_SEPARATOR . $file_name . '.pdf');
        } else {

            sleep(10); // Wait for 10 seconds, because the queue might be busy.

            if(file_exists(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'receipts' . DIRECTORY_SEPARATOR . $file_name . '.pdf'))) {
                return storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'receipts' . DIRECTORY_SEPARATOR . $file_name . '.pdf');
            } else {
                throw new Exception("PDF not found for payment: " . $payment_id. ". If you see this exception, then something has gone wrong
            while generating the PDF");
            }
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // TODO Attach PDF along with this
        return $this->subject('['.config('app.ngo_name').'] Your donation was received successfully ✅💚')
                    ->markdown('emails.donation', ['details' => $this->details])
                    ->attach($this->get_receipt_pdf($this->details['id']));
    }
}
