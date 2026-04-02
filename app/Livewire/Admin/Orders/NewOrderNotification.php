<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

class NewOrderNotification extends Component
{
    #[On('echo:orders,.order.created')]
    public function handleOrderCreatedEvent($payload)
    {
        return 0; //refresh
    }
    #[On('echo:orders,.order.updated')]
    public function handleOrderUpdatedEvent($payload)
    {
        return 0; //refresh
    }
    #[Computed()]
    public function numberOfNewOrders()
    {
        return Order::where("order_status", "waiting")->count();
    }
    public function render()
    {
        return view('livewire.admin.orders.new-order-notification', ["numberOfNewOrders" => $this->numberOfNewOrders]);
    }
}
