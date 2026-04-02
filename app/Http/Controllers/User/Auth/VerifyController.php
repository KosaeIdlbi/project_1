<?php

namespace App\Http\Controllers\User\Auth;

use App\Events\VerificationRequire;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VerifyController extends Controller
{
    public function edit()
    {
        return view("user.auth.verify-email");
    }
    public function update()
    {
        $user = User::findorfail(Auth::id());
        $token = Str::random(40);
        $user->update(["email_verification_token" => Hash::make($token), "email_verification_token_expires_at" => now()->addMinute((int)config("verification.expire_time"))]); //use env
        event(new VerificationRequire($user, $token, "user"));
        return redirect()->route("user.verify.edit")->with("new", "تفقد إيميلك لقد أرسلنا لك رسالة تأكيد");
    }
    public function verifyUser($token)
    {
        $user = User::findorfail(Auth::id());
        $expireAt = $user->email_verification_token_expires_at;
        $isNotExpire = now()->lessThanOrEqualTo($expireAt);
        if (Hash::check($token, $user->email_verification_token)  && $isNotExpire) {
            $user->update(["email_verified_at" => now()]);
            return redirect()->route("user.home")->with("verified", "your account verified successfully");
        } else {
            return redirect()->route("user.verify.edit")->with("unverified", "رتبط التوثيق غير صحيح او انه منته الصلاحية");
        }
    }
}
