<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class AdminReply extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Response Mail')->markdown('emails.contact.reply')->with('data', $this->data);
        if ($this->data->files !== "") {
            $this->attach(Storage::path($this->data->files), [
                'as' => explode('/', $this->data->files)[1]
            ]);
        }

        return $this;
    }
}
