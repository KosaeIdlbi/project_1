<?php

namespace App\Livewire\User;

use Livewire\Component;

class NavbarProfileData extends Component
{
    public $user;
    protected $listeners = ["updatedProfile"];
    public function updatedProfile()
    {
        return 0;
    }
    public function render()
    {
        return view('livewire.user.navbar-profile-data');
    }
}
