<?php

namespace App\Livewire\Admin\catigories;

use App\Models\Catigory as ModelsCatigory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Catigory extends Component
{
    use WithFileUploads;
    public $name;
    public $order;
    public $catigory;
    public $Img;
    public $img_updated = false;
    public $show = "default";
    protected $listeners = ["refresh"];
    public function mount()
    {
        $this->name = $this->catigory->name;
        $this->order = $this->catigory->order;
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
            if ($this->name == $this->catigory->name) {
                $this->validate([
                    "name" => "required|string|max:255",
                    "order" => "required|string|max:255",
                    "Img" => "mimetypes:image/jpg,image/jpeg,image/png|max:1024",
                ]);
            } else {
                $this->validate([
                    "name" => "required|string|max:255|unique:catigories,name",
                    "order" => "required|string|max:255",
                    "Img" => "mimetypes:image/jpg,image/jpeg,image/png|max:1024",
                ]);
            }
        } else {
            if ($this->name == $this->catigory->name) {
                $this->validate([
                    "name" => "required|string|max:255",
                    "order" => "required|string|max:255",
                ]);
            } else {
                $this->validate([
                    "name" => "required|string|max:255|unique:catigories,name",
                    "order" => "required|string|max:255",
                ]);
            }
        }


        $this->catigory->update([
            "name" => $this->name,
            "order" => $this->order,
        ]);
        if ($this->Img) {
            if ($this->catigory->img) {
                Storage::disk("catigories")->delete($this->catigory->img->path);
                $this->catigory->img()->delete();
                $path = $this->Img->store("", "catigories");
                $this->catigory->img()->create([
                    "path" => $path,
                ]);
            }
        }

        $this->catigory = ModelsCatigory::find($this->catigory->id);
        $this->reset("Img", "img_updated");
        $this->show = "default";
        session()->flash("updated", "تعديل المنتج");
    }
    public function available()
    {
        $this->catigory->update([
            "available" => 1,
        ]);
    }
    public function unavailable()
    {
        $this->catigory->update([
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
        $this->catigory->delete();
        $this->show = "deleted";
        session()->flash("deleted", "حذف المنتج");
        $this->dispatch("refresh");
    }
    public function render()
    {
        return view('livewire.admin.catigories.catigory');
    }
}
