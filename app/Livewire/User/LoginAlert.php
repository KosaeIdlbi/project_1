<?php

namespace App\Livewire\User;

use Livewire\Component;

class LoginAlert extends Component
{
    public $login_alert = false;
    protected $listeners = ["loginAlert"];
    public function loginAlert()
    {
        $this->login_alert = true;
    }
    public function close()
    {
        $this->login_alert = false;
    }
    public function render()
    {
        return view('livewire.user.login-alert');
    }
}
