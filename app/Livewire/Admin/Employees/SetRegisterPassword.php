<?php

namespace App\Livewire\Admin\Employees;

use App\Models\RegisterPassword;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class SetRegisterPassword extends Component
{
    public $password;
    public $password_confirmation;
    public function save()
    {
        $this->validate([
            "password" => "required|confirmed|min:8",
            "password_confirmation" => "required"
        ]);
        if (RegisterPassword::first()) {
            RegisterPassword::first()->update([
                "password" => Hash::make($this->password)
            ]);
            $this->reset("password", "password_confirmation");
        } else {
            RegisterPassword::create(["password" => Hash::make($this->password)]);
            $this->reset("password", "password_confirmation");
        }
    }
    public function render()
    {
        return view('livewire.admin.employees.set-register-password');
    }
}
