<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Events\VerificationRequire;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VerifyController extends Controller
{
    public function edit()
    {
        return view("admin.auth.verify-email");
    }
    public function update(Request $request)
    {
        $user = Admin::findorfail(Auth::guard("admin")->id());
        $token = Str::random(40);
        $user->update(["email_verification_token" =>  Hash::make($token), "email_verification_token_expires_at" => now()->addMinute((int)config("verification.expire_time"))]); //use env
        event(new VerificationRequire($user, $token, "admin"));
        return redirect()->route("admin.verify.edit")->with("new", "we sent a new verify link check your email");
    }
    public function verifyUser($token)
    {
        $user = Admin::findorfail(Auth::guard("admin")->id());
        $expireAt = $user->email_verification_token_expires_at;
        $isNotExpire = now()->lessThanOrEqualTo($expireAt);
        if (Hash::check($token, $user->email_verification_token) && $isNotExpire) {
            $user->update(["email_verified_at" => now()]);
            return redirect()->route("admin.dashboard")->with("verified", "your account verified successfully");
        } else {
            return redirect()->route("admin.verify.edit")->with("unverified", "your verified link is incorrect or expired");
        }
    }
}
