<?php

namespace App\Events\Donations;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddDonation{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($donation, $action, $id = null)
    {
        $this->donation = $donation;
        $this->action = $action;
        $this->id = $id;
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
