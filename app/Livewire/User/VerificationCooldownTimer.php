<?php

namespace App\Livewire\User;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VerificationCooldownTimer extends Component
{

    public $minutes;
    public $secondes;
    public $user;
    public function mount()
    {
        $this->user = Auth::user();
    }
    public function render()
    {
        // وقت الانتهاء بعد 30 دقيقة من آخر إرسال
        $diff = Carbon::parse($this->user->email_verification_token_expires_at)->subMinutes(config("verification.expire_time"))->addMinutes(30)->diff(now());
        if (Carbon::parse($this->user->email_verification_token_expires_at)->subMinutes(config("verification.expire_time"))->addMinutes(30)->diffInSeconds(now()) >= 0) {
            $this->minutes =  null;
            $this->secondes =  null;
        } else {
            $this->minutes =  $diff->i;
            $this->secondes =  $diff->s;
        }
        return view('livewire.user.verification-cooldown-timer');
    }
}
