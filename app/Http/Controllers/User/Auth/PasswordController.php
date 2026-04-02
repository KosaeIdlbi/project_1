<?php

namespace App\Http\Controllers\User\Auth;

use App\Events\ResetPassword;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class PasswordController extends Controller
{
    public function create()
    {
        return view("user.auth.forget-password");
    }
    public function store(Request $request)
    {
        $messages = [
            'email.required' => 'حقل البريد الإلكتروني مطلوب.',
            'email.string' => 'حقل البريد الإلكتروني يجب أن يكون نصاً.',
            'email.email' => 'الرجاء إدخال عنوان بريد إلكتروني صحيح.',
            'email.max' => 'البريد الإلكتروني يجب ألا يزيد عن 255 حرف.',
        ];
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        ], $messages);
        $user = User::where("email", "=", $request->email)->first();
        if ($user == null) {
            return redirect()->back()->with("new", "تفقد إيميلك لقد أرسلنا لك رسالة تأكيد");
        } else {
            $token = Str::random(40);
            DB::table("password_reset_tokens")->insert([
                "email" => $request->email,
                "token" => hash('sha256', $token),
                "created_at" => now(),
            ]);
            event(new ResetPassword($user, $token, "user"));
            return redirect()->back()->with("new", "تفقد إيميلك لقد أرسلنا لك رسالة تأكيد");
        }
    }
    public function edit($token)
    {
        $data = DB::table("password_reset_tokens")->where("token", "=", hash('sha256', $token))->first();
        if ($data) {
            $created_at = Carbon::parse($data->created_at);
            $isNotExpire = ($created_at->diffInMinutes(now()) <= config("password.expire_time")) ? true : false;
            if ($isNotExpire) {
                return view("user.auth.reset-password", ["token" => $token]);
            } else {
                return response("invalid link");
            }
        } else {
            return response("invalid link");
        }
    }
    public function update($token, Request $request)
    {
        $data = DB::table("password_reset_tokens")->where("token", "=", hash('sha256', $token))->first();
        if ($data) {
            $created_at = Carbon::parse($data->created_at);
            $isNotExpire = ($created_at->diffInMinutes(now()) <= config("password.expire_time")) ? true : false;
            if ($isNotExpire) {
                $request->validate([
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);
                $email = $data->email;
                $user = User::where("email", "=", $email)->first();
                $user->update(["password" => Hash::make(trim($request->password))]);
                return redirect()->route("user.login.create")->with("password_updated", "your password updated");
            } else {
                return response("invalid link");
            }
        } else {
            return response("invalid link");
        }
    }
}
