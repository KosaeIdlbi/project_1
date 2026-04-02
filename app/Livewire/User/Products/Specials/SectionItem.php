<?php

namespace App\Livewire\User\Products\Specials;

use App\Models\CartItem;
use App\Models\FavItem;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;

class SectionItem extends Component
{
    public $product;
    public $user;
    public $IsFavItem;
    public $IsCartItem;
    protected $listeners = ["refresh"];
    public function refresh()
    {
        return 0;
    }
    #[Renderless]
    #[On('echo:products,.product.deleted')]
    public function handleProductDeletedEvent($payload)
    {
        if ($this->product->id == $payload["product_id"]) {
            $this->dispatch("refresh");
        }
    }
    #[Renderless]
    #[On('echo:products,.product.updated')]
    public function handleProductUpdatedEvent($payload)
    {
        if ($this->product->id == $payload["product_id"]) {
            $this->dispatch("refresh");
        }
    }
    public function mount()
    {
        if ($this->user) {
            $this->IsFavItem = FavItem::where("user_id", $this->user->id)
                ->where("product_id", $this->product->id)->first();

            $this->IsCartItem = CartItem::where("user_id", $this->user->id)
                ->where("product_id", $this->product->id)->first();
        }
    }
    public function addToFav()
    {
        if ($this->user) {
            FavItem::create([
                "user_id" => $this->user->id,
                "product_id" => $this->product->id,
            ]);
            $this->IsFavItem = true;
            $this->dispatch("refreshFavButton");
        } else {
            $this->dispatch("loginAlert");
        }
    }
    public function removeFromFav()
    {
        if ($this->user) {
            FavItem::where("user_id", $this->user->id)
                ->where("product_id", $this->product->id)
                ->delete();
            $this->IsFavItem = false;
            $this->dispatch("refreshFavButton");
        } else {
            $this->dispatch("loginAlert");
        }
    }
    public function addToCart()
    {
        if ($this->user) {
            CartItem::create([
                "user_id" => $this->user->id,
                "product_id" => $this->product->id,
            ]);
            $this->IsCartItem = true;
            $this->dispatch("refreshCartButton", "add", $this->product->price);
        } else {
            $this->dispatch("loginAlert");
        }
    }
    public function removeFromCart()
    {
        if ($this->user) {
            CartItem::where("user_id", $this->user->id)
                ->where("product_id", $this->product->id)
                ->delete();
            $this->IsCartItem = false;
            $this->dispatch("refreshCartButton", "remove", $this->product->price);
        } else {
            $this->dispatch("loginAlert");
        }
    }
    public function render()
    {
        return view('livewire.user.products.specials.section-item');
    }
}
