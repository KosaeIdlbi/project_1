<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Catigory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatigoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $user = (Auth::guard("web")->check()) ? Auth::guard("web")->user() : null;
        $catigories = Catigory::orderBy("order", "desc")->get();
        return view("user.catigories", ["catigories" => $catigories, "user" => $user]);
    }
}
