<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;


class Confirm extends Mailable
{
    use Queueable, SerializesModels;
    public $payment;
    public $pdfpath;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payment, $pdfpath)
    {
        $this->payment = $payment;
        $this->pdfpath = $pdfpath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdfpath = storage_path("../".$this->pdfpath);
        return $this->markdown('admin.emails.confirm')->subject('['.env("APP_NAME").'] New Mail | Payment Received')->attach($this->pdfpath, ['as'=>'receipt.pdf', 'mime'=>'application/pdf']);
    }
}
