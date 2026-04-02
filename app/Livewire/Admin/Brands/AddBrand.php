<?php

namespace App\Livewire\Admin\Brands;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddBrand extends Component
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
                "name" => "required|string|max:255|unique:brands,name",
                "order" => "required|string|max:255",
                "Img" => "mimetypes:image/jpg,image/jpeg,image/png|max:10240",
            ]);
        } else {
            $this->validate([
                "name" => "required|string|max:255|unique:brands,name",
                "order" => "required|string|max:255",
            ]);
        }

        $brand = Brand::create(["name" => $this->name, "order" => $this->order]);
        $path = $this->Img->store("", "brands");
        $brand->img()->create([
            "path" => $path,
        ]);
        session()->flash("stored", " اضافة الماركة الجديدة ");
        $this->reset("name", "order", "Img");
    }
    public function resetValues()
    {
        $this->reset("name", "order", "Img");
    }
    public function render()
    {
        return view('livewire.admin.brands.add-brand');
    }
}
