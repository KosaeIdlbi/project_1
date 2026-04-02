<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view("admin/auth/login");
    }
    public function store(Request $request)
    {
        if (Auth::guard("admin")->attempt(["email" => $request->email, "password" => $request->password], (bool)$request->remember)) {
            $request->session()->regenerate(); // إعادة إنشاء الـ session ID للحماية
            return redirect()->route("admin.dashboard");
        } else {
            return redirect()->route("admin.login.create")->with("fail", "email or password is not correct");
        }
    }
}
