<?php

namespace App\Livewire\User\Products\Cart;

use App\Models\CartItem;
use Livewire\Component;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\On;

class CartButton extends Component
{
    public $cart_items;
    public $total = 0;
    public $user;
    public $count = 0;
    public $listeners = ["refreshCartButton", "clearCartButton"];
    public function mount()
    {
        $this->cart_items = CartItem::whereHas("user", function ($query) {
            $query->where("id", $this->user->id);
        })->whereHas("product", function ($query) {
            $query->where("deleted_at", "=", null);
        })->get();
        foreach ($this->cart_items as $item) {
            if ($item->product->has_offer) {
                $this->total += $item->product->offer_price;
            } else {
                $this->total += $item->product->price;
            }
        }
        $this->count = $this->cart_items->count();
    }
    public function refreshCartButton($ope, $price, $quantity = 1)
    {
        if ($ope == "add") {

            $this->total += $price;
            $this->count += $quantity;
        } elseif ($ope == "remove") {

            $this->total -= $price;
            $this->count -= $quantity;
        }
    }
    public function clearCartButton()
    {
        $this->reset("total", "count");
    }
    public function render()
    {
        return view('livewire.user.products.cart.cart-button');
    }
}
