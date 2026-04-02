<?php

namespace App\Events\Order;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order_id;
    public $user_id;
    public function __construct($order_id, $user_id)
    {
        $this->order_id = $order_id;
        $this->user_id = $user_id;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('orders'),
        ];
    }
    public function broadcastAs()
    {
        return 'order.updated';
    }
}
