<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class TestimonialSubmitted extends Mailable
{
    use Queueable, SerializesModels;
    public $testimonial;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($testimonial)
    {
        $this->testimonial = $testimonial;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->testimonial->hashed_id = Crypt::encryptString($this->testimonial->id);
        return $this->markdown('admin.emails.testimonialsubmitted')->subject(env("APP_NAME").' | New Testimonial Submitted!')->with('testimonial', (object) $this->testimonial);
    }
}
