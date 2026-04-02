<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutUsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $user = (Auth::guard("web")->check()) ? Auth::guard("web")->user() : null;
        return view("user.about-us", ["user" => $user]);
    }
}
