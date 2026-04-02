<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $admin = Auth::guard("admin")->user();
        return view("admin.profile", ["admin" => $admin]);
    }
}
