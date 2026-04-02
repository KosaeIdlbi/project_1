<?php

namespace App\Livewire\Admin\Tags;

use App\Models\Tag as ModelsTag;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Tag extends Component
{

    use WithFileUploads;
    public $name;
    public $order;
    public $tag;
    public $Img;
    public $img_updated = false;
    public $show = "default";
    protected $listeners = ["refresh"];
    public function mount()
    {
        $this->name = $this->tag->name;
        $this->order = $this->tag->order;
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
            if ($this->name == $this->tag->name) {
                $this->validate([
                    "name" => "required|string|max:255",
                    "order" => "required|string|max:255",
                    "Img" => "mimetypes:image/jpg,image/jpeg,image/png|max:1024",
                ]);
            } else {
                $this->validate([
                    "name" => "required|string|max:255|unique:tags,name",
                    "order" => "required|string|max:255",
                    "Img" => "mimetypes:image/jpg,image/jpeg,image/png|max:1024",
                ]);
            }
        } else {
            if ($this->name == $this->tag->name) {
                $this->validate([
                    "name" => "required|string|max:255",
                    "order" => "required|string|max:255",
                ]);
            } else {
                $this->validate([
                    "name" => "required|string|max:255|unique:tags,name",
                    "order" => "required|string|max:255",
                ]);
            }
        }


        $this->tag->update([
            "name" => $this->name,
            "order" => $this->order,
        ]);
        if ($this->Img) {
            if ($this->tag->img) {
                Storage::disk("tags")->delete($this->tag->img->path);
                $this->tag->img()->delete();
                $path = $this->Img->store("", "tags");
                $this->tag->img()->create([
                    "path" => $path,
                ]);
            }
        }

        $this->tag = ModelsTag::find($this->tag->id);
        $this->reset("Img", "img_updated");
        $this->show = "default";
        session()->flash("updated", "تعديل الماركة");
    }
    public function available()
    {
        $this->tag->update([
            "available" => 1,
        ]);
    }
    public function unavailable()
    {
        $this->tag->update([
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
        $this->tag->delete();
        $this->show = "deleted";
        session()->flash("deleted", "حذف الماركة");
        $this->dispatch("refresh");
    }
    public function render()
    {
        return view('livewire.admin.tags.tag');
    }
}
