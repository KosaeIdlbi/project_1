<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class NavbarProfileData extends Component
{
    public $admin;
    protected $listeners = ["updatedProfile"];
    public function updatedProfile()
    {
        return 0;
    }
    public function render()
    {
        return view('livewire.admin.navbar-profile-data');
    }
}
