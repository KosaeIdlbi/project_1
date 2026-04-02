<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rules;


class Profile extends Component
{
    use WithFileUploads;
    public $user;
    public $Img;
    public $show = "personal_info";
    public function mount()
    {
        $this->name = $this->user->name;
    }
    public function updatedImg()
    {
        $this->validate([
            "Img" => "mimetypes:image/jpg,image/jpeg,image/png|max:10240",
        ]);

        if ($this->user->Img) {
            Storage::disk("users")->delete($this->user->Img->path);
            $this->user->img()->delete();
            $path = $this->Img->store("", "users");
            $this->user->img()->create([
                "path" => $path,
            ]);
        } else {

            $path = $this->Img->store("", "users");
            $this->user->img()->create([
                "path" => $path,
            ]);
        }
        $this->dispatch("updatedProfile");
    }
    public $TimeZone;
    public function updatedTimeZone()
    {
        $this->user->update(["timezone" => $this->TimeZone]);
    }
    public $name;
    public function updateName()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $this->user->update(["name" => $this->name]);
        $this->dispatch("updatedProfile");
    }
    public $current_password;
    public $password;
    public $password_confirmation;
    public function updatePassword()
    {
        if (Hash::check($this->current_password, $this->user->password)) {
            $this->validate([
                'current_password' => ['required', Rules\Password::defaults()],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'password_confirmation' => ['required', Rules\Password::defaults()],
            ]);
            $this->user->update(["password" => Hash::make(trim($this->password))]);
            $this->reset("current_password", "password", "password_confirmation");
            session()->flash("success", "تم تحديث كلمة المرور بنجاح");
        } else {
            session()->flash("current_password_incorrect", "كلمة المرور الحالية غير صحيحة");
        }
    }
    public function render()
    {
        return view('livewire.user.profile');
    }
}
