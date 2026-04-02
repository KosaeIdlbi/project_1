<?php

namespace App\Livewire\Admin\Charger;

use App\Models\Charge;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

class NewChargeNotification extends Component
{
    #[On('echo:charges,.charge.created')]
    public function handleChargeCreatedEvent($payload)
    {
        return 0; //refresh
    }
    #[On('echo:charges,.charge.updated')]
    public function handleChargeUpdatedEvent($payload)
    {
        return 0; //refresh
    }
    #[Computed()]
    public function numberOfNewCharges()
    {
        return Charge::where("charge_status", "waiting")->count();
    }
    public function render()
    {
        return view('livewire.admin.charger.new-charge-notification', ["numberOfNewCharges" => $this->numberOfNewCharges]);
    }
}
