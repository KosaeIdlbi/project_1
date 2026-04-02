<?php

namespace App\Livewire\Admin\Coupons;

use App\Models\Coupon;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Computed;

class ViewCoupons extends Component
{
    public $code;
    public $discount;
    public $expire_at;
    #[Computed()]
    public function coupons()
    {
        return Coupon::get();
    }
    public function store()
    {
        $this->validate([
            "code" => "required|string|unique:coupons,code",
            "discount" => "required|numeric|gte:1|lte:100",
            "expire_at" => "required|date"
        ], [
            "code.required" => "هذا الحقل مطلوب",
            "discount.required" => "هذا الحقل مطلوب",
            "expire_at.required" => "هذا الحقل مطلوب",
        ]);
        Coupon::create([
            "code" => $this->code,
            "discount" => $this->discount,
            "expire_at" => Carbon::parse($this->expire_at),
        ]);
        $this->cancel();
    }
    public function delete($id)
    {
        Coupon::findorfail($id)->delete();
    }
    public function cancel()
    {
        $this->reset("code", "discount", "expire_at");
        $this->resetErrorBag();
    }
    public function render()
    {
        return view('livewire.admin.coupons.view-coupons', ["coupons" => $this->coupons]);
    }
}
