<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __invoke()
    {
        $user = Auth::guard("web")->user();
        return view("user.orders", ["user" => $user]);
    }
}
