<?php

namespace App\Livewire\User\Products\Cart;

use Livewire\Component;
use Livewire\Attributes\Renderless;

class CartItem extends Component
{
    //فاليديت الكمية عند الشراء
    public $cart_item;
    public $quantity = 1;
    public $price;
    public $total;
    protected $listeners = ["sendCartItemData"];
    public function mount()
    {
        if ($this->cart_item->has_offer) {
            $this->price = $this->cart_item->offer_price;
        } else {
            $this->price = $this->cart_item->price;
        }
        $this->total = $this->price;
        $this->dispatch("calcSubTotal", $this->price, "add");
    }
    public function remove()
    {
        $this->cart_item->cartItems()->delete();
        $this->dispatch("calcSubTotal", $this->total, "sub");
        $this->dispatch("refresh");
        $this->dispatch("refreshCartButton", "remove", $this->total, $this->quantity);
    }
    public function add()
    {
        if ($this->quantity < $this->cart_item->able_to_buy_quantity && $this->quantity < $this->cart_item->quantity) {
            $this->quantity++;
            $this->total = ($this->price * $this->quantity);
            $this->dispatch("calcSubTotal", $this->price, "add");
            $this->dispatch("refreshCartButton", "add", $this->price);
        }
    }
    public function sub()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->total = ($this->price * $this->quantity);
            $this->dispatch("calcSubTotal", $this->price, "sub");
            $this->dispatch("refreshCartButton", "remove", $this->price);
        }
    }
    #[Renderless]
    public function sendCartItemData()
    {
        $this->dispatch(
            "getCartItemData",
            $this->cart_item->id,
            $this->quantity,
        );
    }
    public function render()
    {
        return view('livewire.user.products.cart.cart-item');
    }
}
