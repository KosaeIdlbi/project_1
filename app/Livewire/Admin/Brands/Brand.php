<?php

namespace App\Livewire\Admin\Brands;

use App\Models\Brand as ModelsBrand;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Brand extends Component
{

    use WithFileUploads;
    public $name;
    public $order;
    public $brand;
    public $Img;
    public $img_updated = false;
    public $show = "default";
    protected $listeners = ["refresh"];
    public function mount()
    {
        $this->name = $this->brand->name;
        $this->order = $this->brand->order;
    }
    public function edit()
    {
        $this->show = "ableToEdit";
    }
    public function remove()
    {
        $this->show = "ableToRemove";
    }
    public function updatedImg()
    {
        $this->img_updated = true;
        $this->validate([
            "Img" => "mimetypes:image/jpg,image/jpeg,image/png|max:1024",
        ]);
    }
    public function update()
    {
        if ($this->img_updated) {
            if ($this->name == $this->brand->name) {
                $this->validate([
                    "name" => "required|string|max:255",
                    "order" => "required|string|max:255",
                    "Img" => "mimetypes:image/jpg,image/jpeg,image/png|max:1024",
                ]);
            } else {
                $this->validate([
                    "name" => "required|string|max:255|unique:brands,name",
                    "order" => "required|string|max:255",
                    "Img" => "mimetypes:image/jpg,image/jpeg,image/png|max:1024",
                ]);
            }
        } else {
            if ($this->name == $this->brand->name) {
                $this->validate([
                    "name" => "required|string|max:255",
                    "order" => "required|string|max:255",
                ]);
            } else {
                $this->validate([
                    "name" => "required|string|max:255|unique:brands,name",
                    "order" => "required|string|max:255",
                ]);
            }
        }


        $this->brand->update([
            "name" => $this->name,
            "order" => $this->order,
        ]);
        if ($this->Img) {
            if ($this->brand->img) {
                Storage::disk("brands")->delete($this->brand->img->path);
                $this->brand->img()->delete();
                $path = $this->Img->store("", "brands");
                $this->brand->img()->create([
                    "path" => $path,
                ]);
            }
        }

        $this->brand = ModelsBrand::find($this->brand->id);
        $this->reset("Img", "img_updated");
        $this->show = "default";
        session()->flash("updated", "تعديل الماركة");
    }
    public function available()
    {
        $this->brand->update([
            "available" => 1,
        ]);
    }
    public function unavailable()
    {
        $this->brand->update([
            "available" => 0,
        ]);
    }
    public function cancel()
    {
        $this->show = "default";
        $this->reset("Img", "img_updated");
        $this->resetErrorBag();
    }

    public function destroy()
    {
        $this->brand->delete();
        $this->show = "deleted";
        session()->flash("deleted", "حذف الماركة");
        $this->dispatch("refresh");
    }
    public function render()
    {
        return view('livewire.admin.brands.brand');
    }
}
