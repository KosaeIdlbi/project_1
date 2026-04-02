<?php

namespace App\Livewire\Admin\Charger;

use App\Models\ShamCashAccount;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddShamcash extends Component
{
    use WithFileUploads;
    public $account_number;
    public $minimum_charge;
    public $maximum_charge;
    public $Img;
    public $shamcash;
    public function mount()
    {
        $this->shamcash = ShamCashAccount::first();
        $this->account_number = $this->shamcash->account_number;
        $this->minimum_charge = $this->shamcash->minimum_charge;
        $this->maximum_charge = $this->shamcash->maximum_charge;
    }
    public function updatedImg()
    {
        $this->validate([
            "Img" => "mimetypes:image/jpg,image/jpeg,image/png|max:10240",
        ]);
    }
    public function store()
    {
        if ($this->Img) {
            $this->validate([
                "account_number" => "string|required",
                "minimum_charge" => "required|numeric",
                "maximum_charge" => "required|numeric",
                "Img" => "mimetypes:image/jpg,image/jpeg,image/png|max:10240",
            ]);
            if ($this->shamcash->img) {
                Storage::disk("shamcash")->delete($this->shamcash->img->path);
                $path = $this->Img->store("", "shamcash");
                $this->shamcash->img()->update([
                    "path" => $path,
                ]);
            } else {
                $path = $this->Img->store("", "shamcash");
                $this->shamcash->img()->create([
                    "path" => $path,
                ]);
            }
        } else {
            $this->validate([
                "account_number" => "string|required",
                "minimum_charge" => "required|numeric",
                "maximum_charge" => "required|numeric",
            ]);
        }

        $this->shamcash->update([
            "account_number" => $this->account_number,
            "minimum_charge" => $this->minimum_charge,
            "maximum_charge" => $this->maximum_charge,
        ]);
        session()->flash("updated", "تحديث معلومات الحساب");
    }
    public function resetValues()
    {
        $this->reset("account_number", "minimum_charge", "maximum_charge", "Img");
    }
    public function render()
    {
        return view('livewire.admin.charger.add-shamcash');
    }
}
