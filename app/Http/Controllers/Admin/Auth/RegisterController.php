<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Events\VerificationRequire;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\RegisterPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function create()
    {
        return view("admin/auth/register");
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:admins,email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            "register_password" => "required"
        ]);
        if (Hash::check($request->register_password, RegisterPassword::first()->password)) {
            $token = Str::random(40);
            $expireAt = now()->addMinute((int)config("verification.expire_time"));
            $user = Admin::create([
                "name" => trim($request->name),
                "email" => trim($request->email),
                "password" => Hash::make(trim($request->password)),
                "email_verification_token" =>  Hash::make($token),
                "email_verification_token_expires_at" => $expireAt,
            ]);
            Auth::guard("admin")->login($user);
            event(new VerificationRequire($user, $token, "admin"));
            return redirect()->route("admin.verify.edit")->with("register", "your account register successfully");
        } else {
            return response("register password is not correct");
        }
    }
}
