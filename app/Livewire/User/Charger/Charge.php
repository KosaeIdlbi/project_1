<?php

namespace App\Livewire\User\Charger;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Renderless;

class Charge extends Component
{
    protected $listeners = ["refreshCharge"];
    public function refreshCharge()
    {
        return 0;
    }
    #[Renderless]
    #[On('echo:charges,.charge.updated')]
    public function handleChargeUpdatedEvent($payload)
    {
        if ($payload["charge_id"] == $this->charge->id) {
            $this->dispatch("refreshCharge");
        }
    }
    public $charge;
    public function render()
    {
        return view('livewire.user.charger.charge');
    }
}
