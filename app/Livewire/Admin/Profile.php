<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Profile extends Component
{
    use WithFileUploads;
    public $admin;
    public $Img;
    public $show = "personal_info";
    public function mount()
    {
        $this->name = $this->admin->name;
    }
    public function updatedImg()
    {
        $this->validate([
            "Img" => "mimetypes:image/jpg,image/jpeg,image/png|max:10240",
        ]);

        if ($this->admin->Img) {
            Storage::disk("users")->delete($this->admin->Img->path);
            $this->admin->img()->delete();
            $path = $this->Img->store("", "users");
            $this->admin->img()->create([
                "path" => $path,
            ]);
        } else {

            $path = $this->Img->store("", "users");
            $this->admin->img()->create([
                "path" => $path,
            ]);
        }
        $this->dispatch("updatedProfile");
    }
    public $TimeZone;
    public function updatedTimeZone()
    {
        $this->admin->update(["timezone" => $this->TimeZone]);
    }
    public $name;
    public function updateName()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $this->admin->update(["name" => $this->name]);
        $this->dispatch("updatedProfile");
    }
    public $current_password;
    public $password;
    public $password_confirmation;
    public function updatePassword()
    {
        if (Hash::check($this->current_password, $this->admin->password)) {
            $this->validate([
                'current_password' => ['required', Rules\Password::defaults()],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'password_confirmation' => ['required', Rules\Password::defaults()],
            ]);
            $this->admin->update(["password" => Hash::make(trim($this->password))]);
            $this->reset("current_password", "password", "password_confirmation");
            session()->flash("success", "تم تحديث كلمة المرور بنجاح");
        } else {
            session()->flash("current_password_incorrect", "كلمة المرور الحالية غير صحيحة");
        }
    }
    public function render()
    {
        return view('livewire.admin.profile');
    }
}
