<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Operations;
use App\Models\Donations;

class ProcurementList extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($output, $field_manager)
    {        
        $this->pdf = $output;
        $this->field_manager = $field_manager;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.ProcurementList', [            
            'field_manager' => $this->field_manager,
        ])->subject('Procurement list for mission')
        ->attachData($this->pdf, 'ProcurementList.pdf', [
            'mime' => 'application/pdf',
        ]);
    }
}
