<?php

namespace App\Livewire\User\Products\Fav;

use App\Models\FavItem;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class ViewFav extends Component
{
    use WithPagination;
    public $user;
    public $listeners = ["favRefresh"];
    #[Computed()]
    public function favItems()
    {
        return Product::whereHas("favItems", function ($query) {
            $query->where("user_id", $this->user->id)->orderBy("created_at", "desc");
        })->simplePaginate(10);
    }
    public function clearFav()
    {
        FavItem::where("user_id", $this->user->id)->delete();
        $this->dispatch("refreshFavButton");
    }
    public function render()
    {
        return view('livewire.user.products.fav.view-fav', ["fav_items" => $this->favItems]);
    }
}
