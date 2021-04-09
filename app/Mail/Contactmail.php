<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contactmail extends Mailable
{
    use Queueable, SerializesModels;
protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data=$data; 
       }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject['Response Mail']
                   ->attach($this->data['file']->getRealPath(),[
                       'as' => $this->data['file']->getClientOriginalName()
                   ]) ;
    }
}
