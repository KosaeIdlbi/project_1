<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Models\ShamCashAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function create()
    {
        $user = Auth::guard("web")->user();
        $charges = Charge::with(["deniedReason"])->whereHas("user", function ($query) use ($user) {
            $query->where("user_id", $user->id);
        })->orderBy("created_at", "desc")->get();
        $sham_cash_account = ShamCashAccount::first();
        $last_charge = Charge::orderBy("created_at", "desc")->where("charge_status", "success")->first();
        return view("user.wallet", ["user" => $user, "charges" => $charges, "last_charge" => $last_charge, "sham_cash_account" => $sham_cash_account]);
    }
    public function store(Request $request)
    {
        $sham_cash_account = ShamCashAccount::first();
        $request->validate([
            "receipt" => "required|mimetypes:image/jpg,image/jpeg,image/png|max:10240",
            "transcation_number" => "required",
            "amount" => ($sham_cash_account) ? "required|gte:$sham_cash_account->minimum_charge|lte:$sham_cash_account->maximum_charge" : "required",
        ], [
            "receipt.required" => "الرجاء ارفاق صورة الاشعار",
            "transcation_number.required" => "ادخل رقم عملية التحويل",
            "amount.required" => "يرجى ادخال المبلغ المراد شحنه ",
            "amount.lte" => " الحد الأقصى للشحن عشرة الاف ليرة سورية",
            "amount.gte" => "الحد الأدنى للشحن خمسمائة ليرة سورية",
        ]);
        if (Auth::guard("web")->user()->balance + $request->amount > ShamCashAccount::first()->maximum_charge) {
            return redirect()->route("user.wallet.create")->with("charged_field", "لا يمك شحن الحساب بسبب تجاوز حدود المحفظة");
        }
        $charge = Charge::create([
            "user_id" => Auth::guard("web")->id(),
            "receipt" => $request->receipt,
            "transcation_number" => $request->transcation_number,
            "amount" => $request->amount,
            "charge_status" => "waiting",
        ]);
        $path = $request->file('receipt')->store('', "shamcash");
        $charge->img()->create([
            "path" => $path,
        ]);
        return redirect()->route("user.wallet.create");
    }
}
