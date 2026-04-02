<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class Order extends Component
{
    public $admin;
    public $order;
    public function cancelOrder()
    {
        if ($this->admin->id == $this->order->admin_id) {
            $this->order->update([
                "order_status" => "cancelled",
            ]);
            $this->order->user->update([
                "balance" => $this->order->user->balance + $this->order->order_price
            ]);
            for ($i = 0; $i < count($this->order->product_name); $i++) {
                $product = Product::where("name", $this->order->product_name[$i])->first();
                if ($product) {
                    $product->updateQuietly([
                        "quantity" => $product->quantity + $this->order->quantity[$i]
                    ]);
                }
            }
        }
    }
    public function receiveOrder()
    {
        if ($this->order->order_status != "received" && $this->order->order_status != "cancelled") {
            $this->order->update([
                "order_status" => "received",
                "admin_id" => $this->admin->id,
            ]);
            $this->dispatch("refreshOrders"); //نحتاج تحدييث سريع على المستوى المحلي
        }
    }
    public function deliveOrder()
    {
        if ($this->admin->id == $this->order->admin_id) {
            $this->order->update([
                "order_status" => "delivery_in_progress",
            ]);
            $this->dispatch("refreshOrders"); //نحتاج تحدييث سريع على المستوى المحلي
        }
    }
    public function setAsDelivered()
    {
        if ($this->admin->id == $this->order->admin_id) {
            $this->order->update([
                "order_status" => "delivered",
            ]);
            $this->dispatch("refreshOrders");
        }
    }
    public function render()
    {
        return view('livewire.admin.orders.order');
    }
}
