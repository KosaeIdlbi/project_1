<?php

namespace App\Livewire\User\Orders;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;


class Order extends Component
{
    protected $listeners = ["refreshOrder"];
    public function refreshOrder()
    {
        return 0;
    }
    public $show;
    public $order;
    #[Renderless]
    #[On('echo:orders,.order.updated')]
    public function handleOrderUpdatedEvent($payload)
    {
        if ($this->order->id == $payload["order_id"]) {
            $this->dispatch("refreshOrder");
        }
    }
    public $user;
    public function cancelOrder()
    {
        if ($this->order->order_status == "waiting") {
            $this->order->update([
                "order_status" => "cancelled",
            ]);
            $this->user->update([
                "balance" => $this->user->balance + $this->order->order_price
            ]);
            for ($i = 0; $i < count($this->order->product_name); $i++) {
                $product = Product::where("name", $this->order->product_name[$i])->first();
                if ($product) {
                    if ($product->quantity == 0) {
                        $product->update([ //حتى لا نرسل احداث وتتحدث الواجهة عند المستخدم مع كل عملية اعادة
                            "quantity" => $product->quantity + $this->order->quantity[$i],
                        ]);
                    } else {
                        $product->updateQuietly([ //حتى لا نرسل احداث وتتحدث الواجهة عند المستخدم مع كل عملية اعادة
                            "quantity" => $product->quantity + $this->order->quantity[$i],
                        ]);
                    }
                }
            }
        }
    }
    public function render()
    {
        return view('livewire.user.orders.order');
    }
}
