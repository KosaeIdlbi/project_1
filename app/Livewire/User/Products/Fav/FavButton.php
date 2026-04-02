<?php

namespace App\Livewire\User\Products\Fav;

use App\Models\FavItem;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class FavButton extends Component
{
    public $user;
    protected $listeners = ["refreshFavButton"];
    public $product_deleted_from_dashboard;
    // #[On('echo:products,.product.deleted')]
    // public function handleProductDeletedEvent($payload)
    // {
    //     $this->product_deleted_from_dashboard = true;
    //     $this->refreshFavButton();
    // }
    #[Computed()]
    public function count()
    {
        return FavItem::whereHas("product", function ($query) {
            $query->where("deleted_at", "=", null);
        })->where("user_id", $this->user->id)->count();
    }
    public function refreshFavButton()
    {
        return 0;
    }
    public function render()
    {
        return view('livewire.user.products.fav.fav-button', ["count" => $this->count]);
    }
}
