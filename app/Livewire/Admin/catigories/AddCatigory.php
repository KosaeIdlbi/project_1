<?php

namespace App\Livewire\Admin\catigories;

use App\Models\Catigory;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddCatigory extends Component
{
    use WithFileUploads;
    public $name;
    public $order;
    public $Img;
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
                "name" => "required|string|max:255|unique:catigories,name",
                "order" => "required|string|max:255",
                "Img" => "mimetypes:image/jpg,image/jpeg,image/png|max:10240",
            ]);
        } else {
            $this->validate([
                "name" => "required|string|max:255|unique:catigories,name",
                "order" => "required|string|max:255",
            ]);
        }

        $catigory = Catigory::create(["name" => $this->name, "order" => $this->order]);
        $path = $this->Img->store("", "catigories");
        $catigory->img()->create([
            "path" => $path,
        ]);
        session()->flash("stored", "اضافة القسم الجديد ");
        $this->reset("name", "order", "Img");
    }
    public function resetValues()
    {
        $this->reset("name", "order", "Img");
    }
    public function render()
    {
        return view('livewire.admin.catigories.add-catigory');
    }
}
