<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class ViewOrders extends Component
{

    use WithPagination;
    #[On('echo:orders,.order.updated')]
    public function handleOrderUpdatedEvent($payload)
    {
        return 0; //refresh
    }
    #[On('echo:orders,.order.created')]
    public function handleOrderCreatedEvent($payload)
    {
        return 0; //refresh
    }

    protected $listeners = ["refreshOrders"];
    public function refreshOrders()
    {
        return 0;
    }
    public $admin;
    public $OrderStatus = "waiting";
    public function updatedOrderStatus()
    {
        $this->resetPage();
    }
    public $CreatedAt = "2000/1/1 00:00:00";
    public function updatedCreatedAt()
    {
        $this->resetPage();
        $this->reset("OrderId");
    }
    public $OrderId = "";
    public function updatedOrderId()
    {
        $this->resetPage();
        $this->reset("CreatedAt");
    }
    #[Computed()]
    public function orders()
    {
        if ($this->OrderStatus == "" || $this->OrderStatus == "waiting") {
            return Order::where("id", "like", "%" . $this->OrderId . "%")
                ->where("order_status", "like", "%" . $this->OrderStatus . "%")
                ->where("created_at", ">=", Carbon::parse($this->CreatedAt))
                ->orderBy("created_at", "Asc")->simplepaginate(10);
        } else {
            return Order::where("order_status", "like", "%" . $this->OrderStatus . "%")
                ->where("admin_id", $this->admin->id)
                ->where("id", "like", "%" . $this->OrderId . "%")
                ->where("created_at", ">=", Carbon::parse($this->CreatedAt))
                ->orderBy("created_at", "Asc")->simplepaginate(10);
        }
    }
    public function render()
    {
        return view('livewire.admin.orders.view-orders', ["orders" => $this->orders]);
    }
}
