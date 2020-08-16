<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChargeUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user;
    public $limit;
    public $credit;
    /**
     * Create a new event instance.
     *
     * @param $user
     * @param $limit
     */
    public function __construct($user,$limit,$credit)
    {
        $this->user = $user;
        $this->credit = $credit;
        $this->limit = $limit;
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
