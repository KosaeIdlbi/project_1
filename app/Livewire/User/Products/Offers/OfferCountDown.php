<?php

namespace App\Livewire\User\Products\Offers;

use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;


class OfferCountDown extends Component
{
    public $offer_ends_at;
    public $product_id;
    public $days;
    public $hours;
    public $minutes;
    public $secondes;
    public function countDown()
    {
        $diff = Carbon::parse($this->offer_ends_at)->diff(now());
        if (Carbon::parse($this->offer_ends_at)->diffInSeconds(now()) >= 0) {
            Product::findOrFail($this->product_id)->update([
                "has_offer" => 0,
                "offer_ends_at" => null,
            ]);
        } else {
            $this->days =  $diff->d;
            $this->hours =  $diff->h;
            $this->minutes =  $diff->i;
            $this->secondes =  $diff->s;
        }
    }
    public function render()
    {
        return view('livewire.user.products.offers.offer-count-down');
    }
}
