<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PasswordCooldownTimer extends Component
{
    public $email;
    public $last_request;
    public $minutes;
    public $secondes;
    public function mount()
    {
        $this->last_request = DB::table("password_reset_tokens")
            ->where("email", $this->email)
            ->orderBy("created_at", "desc")
            ->first();
    }
    public function render()
    {
        if ($this->last_request) {  //اذا كان الايميل صحيح عطيني عداد صحيح مبني على قاعدة البيانات

            $diff = Carbon::parse($this->last_request->created_at)->addMinutes(30)->diff(now());
            if (Carbon::parse($this->last_request->created_at)->addMinutes(30)->diffInSeconds(now()) >= 0) {
                $this->minutes =  null;
                $this->secondes =  null;
            } else {
                $this->minutes =  $diff->i;
                $this->secondes =  $diff->s;
            }
        } else {
            $this->minutes =  null;
            $this->secondes =  null;
        }
        return view('livewire.admin.password-cooldown-timer');
    }
}
