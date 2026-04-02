<?php

namespace App\Livewire\Admin\Tags;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddTag extends Component
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
                "name" => "required|string|max:255|unique:tags,name",
                "order" => "required|string|max:255",
                "Img" => "mimetypes:image/jpg,image/jpeg,image/png|max:10240",
            ]);
        } else {
            $this->validate([
                "name" => "required|string|max:255|unique:tags,name",
                "order" => "required|string|max:255",
            ]);
        }

        $tag = Tag::create(["name" => $this->name, "order" => $this->order]);
        $path = $this->Img->store("", "tags");
        $tag->img()->create([
            "path" => $path,
        ]);
        session()->flash("stored", " اضافة الصنف الجديد ");
        $this->reset("name", "order", "Img");
    }
    public function resetValues()
    {
        $this->reset("name", "order", "Img");
    }
    public function render()
    {
        return view('livewire.admin.tags.add-tag');
    }
}
