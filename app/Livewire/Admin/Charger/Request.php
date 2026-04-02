<?php

namespace App\Livewire\Admin\Charger;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Request extends Component
{
    public $request;
    public $DeniedReason;
    public $show;
    public $denied_reasons;
    public $user;
    public $admin;
    public $shamcash;
    public function mount()
    {
        $this->user = User::find($this->request->user_id);
        $this->show = $this->request->charge_status;
    }
    public function deniedRequest()
    {
        if ($this->request->admin_id == $this->admin->id) {
            $this->show = "deniedRequest";
        }
    }
    public function chargeRequest()
    {
        if ($this->request->admin_id == $this->admin->id) {
            $this->show = "chargeRequest";
        }
    }
    public function receive()
    {
        if ($this->request->charge_status != "received") {
            $this->request->update([
                "charge_status" => "received",
                "admin_id" => $this->admin->id,
            ]);
            $this->dispatch("refreshRequests");
        }
    }
    public function confirmDenied()
    {
        if ($this->request->admin_id == $this->admin->id) {
            $this->request->update([
                "charge_status" => "denied",
                "denied_reason_id" => $this->DeniedReason,
            ]);
            $this->dispatch("refreshRequests");
        }
    }
    public function confirmCharge()
    {
        if ($this->request->admin_id == $this->admin->id) {
            if ($this->user->balance + $this->request->amount > $this->shamcash->maximum_charge) {
                session()->flash("charged_faild", "لا يمكن شحن الحساب بسبب تجاوز حدود المحفظة");
            } else {
                $this->request->update([
                    "charge_status" => "success"
                ]);
                $this->user->update([
                    "balance" => $this->user->balance + $this->request->amount,
                ]);
                $this->dispatch("refreshRequests");
            }
        }
    }
    public function cancel()
    {
        $this->show = "received";
        $this->reset("DeniedReason");
    }
    public function render()
    {
        return view('livewire.admin.charger.request');
    }
}
