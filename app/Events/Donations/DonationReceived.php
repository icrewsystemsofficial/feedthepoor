<?php

namespace App\Events\Donations;

use App\Models\Causes;
use App\Models\Donations;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationMail;

class DonationReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details['notes'];
        $cause_id = Causes::where('name', $details['notes']['cause'])->first()->id;
        $this->details['yield_context'] = Causes::where('name', $details['notes']['cause'])->first()->yield_context;
        $this->details['amt_in_words'] = Donations::Show_Amount_In_Words($details['notes']['amount']);
        $this->details['tracking_url'] = route('frontend.track-donation', $details['id']);
        $this->details['id'] = $details['id'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
