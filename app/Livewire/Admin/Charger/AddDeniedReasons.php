<?php

namespace App\Livewire\Admin\Charger;

use App\Models\DeniedReason;
use Livewire\Component;
use Livewire\Attributes\Computed;

class AddDeniedReasons extends Component
{
    public $name;
    public $desc;
    #[Computed()]
    public function denied_reasons()
    {
        return DeniedReason::get();
    }
    public function store()
    {
        $this->validate([
            "name" => "required|string",
            "desc" => "required|string",
        ], [
            "name.required" => "هذا الحقل مطلوب",
            "desc.required" => "هذا الحقل مطلوب",
        ]);
        DeniedReason::create([
            "name" => $this->name,
            "desc" => $this->desc,
        ]);
        $this->reset("name", "desc");
    }
    public function delete($id)
    {
        DeniedReason::findorfail($id)->delete();
    }
    public function cancel()
    {
        $this->reset("name", "desc");
        $this->resetErrorBag();
    }
    public function render()
    {
        return view('livewire.admin.charger.add-denied-reasons', ["denied_reasons" => $this->denied_reasons]);
    }
}
