<?php

namespace App\Events\Donations;

use App\Models\Causes;
use App\Models\Donations;
use App\Models\Campaigns;
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

    public $details;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details['notes'];
        $cause_id = isset($details['notes']['cause']) ? Causes::where('name', $details['notes']['cause'])->first()->id : null;
        $campaign_id = Campaigns::where('campaign_name', $details['notes']['campaign'])->first()->id ?? null;
        $this->details['yield_context'] = $cause_id ? Causes::where('name', $details['notes']['cause'])->first()->yield_context : null;
        $this->details['amt_in_words'] = Donations::Show_Amount_In_Words($details['notes']['amount']);
        $this->details['tracking_url'] = route('frontend.track-donation', $details['id']);
        $this->details['id'] = $details['id'];
        $this->details['quantity'] = $cause_id ? (int) $details['notes']['amount']/Causes::where('name', $details['notes']['cause'])->first()->per_unit_cost : 1;
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
