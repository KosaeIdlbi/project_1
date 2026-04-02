<?php

namespace App\Events\Charge;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChargeCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $charge_id;
    public function __construct($charge_id)
    {
        $this->charge_id = $charge_id;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('charges'),
        ];
    }
    public function broadcastAs()
    {
        return 'charge.created';
    }
}
