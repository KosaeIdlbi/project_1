<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Events\ResetPassword;
use App\Http\Controllers\Controller;
use App\Models\Admin;
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
        return view("admin.auth.forget-password");
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $user = Admin::where("email", "=", $request->email)->first();
        if ($user == null) {
            return redirect()->back()->with("notMatch", "if your email correct you will get link on your email");
        } else {
            $token = Str::random(40);
            DB::table("password_reset_tokens")->insert([
                "email" => $request->email,
                "token" =>  hash('sha256', $token),
                "created_at" => now(),
            ]);
            event(new ResetPassword($user, $token, "admin"));
            return redirect()->back()->with("new", "check your email we send you a reset link");
        }
    }
    public function edit($token)
    {
        return view("admin.auth.reset-password", ["token" => $token]);
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
                $user = Admin::where("email", "=", $email)->first();
                $user->update(["password" => Hash::make($request->password)]);
                return redirect()->route("admin.login.create")->with("password_updated", "your password updated");
            } else {
                return response("invalid link");
            }
        } else {
            return response("invalid link");
        }
    }
}
