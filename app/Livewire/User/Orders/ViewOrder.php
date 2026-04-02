<?php

namespace App\Livewire\User\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class ViewOrder extends Component
{
    use WithPagination;
    public $user;
    #[Computed()]
    public function orders()
    {
        return Order::where("user_id", $this->user->id)->orderBy("created_at", "desc")->simplePaginate(10);
    }
    public function render()
    {
        return view('livewire.user.orders.view-order', ["orders" => $this->orders, "user" => $this->user]);
    }
}
