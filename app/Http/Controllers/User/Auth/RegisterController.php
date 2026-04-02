<?php

namespace App\Http\Controllers\User\Auth;

use App\Events\VerificationRequire;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function create()
    {
        return view("user/auth/register");
    }
    public function store(Request $request)
    {

        $messages = [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'حقل الاسم يجب أن يكون نصاً.',
            'name.max' => 'الاسم يجب ألا يزيد عن 255 حرف.',

            'email.required' => 'حقل البريد الإلكتروني مطلوب.',
            'email.string' => 'حقل البريد الإلكتروني يجب أن يكون نصاً.',
            'email.email' => 'الرجاء إدخال عنوان بريد إلكتروني صحيح.',
            'email.max' => 'البريد الإلكتروني يجب ألا يزيد عن 255 حرف.',
            'email.unique' => 'البريد الإلكتروني مسجل مسبقاً.',

            'password.required' => 'حقل كلمة المرور مطلوب.',
            'password.confirmed' => 'تأكيد كلمة المرور لا يتطابق مع كلمة المرور.',

            // رسائل قواعد كلمة المرور الافتراضية (Minimum 8 characters, etc)
            'password.min' => 'كلمة المرور يجب أن لا تقل عن 8 أحرف.',
        ];

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'unique:admins,email'],
            'password' => ['required', 'confirmed',  Rules\Password::defaults()],
        ], $messages);

        $token = Str::random(40);
        $expireAt = now()->addMinute((int)config("verification.expire_time"));
        $user = User::create([
            "name" => trim($request->name),
            "email" => trim($request->email),
            "password" => Hash::make(trim($request->password)),
            "email_verification_token" =>  Hash::make($token),
            "email_verification_token_expires_at" => $expireAt,
        ]);
        Auth::guard("web")->login($user);
        event(new VerificationRequire($user, $token, "user"));
        return redirect()->route("user.verify.edit")->with("register", "your account register successfully");
    }
}
