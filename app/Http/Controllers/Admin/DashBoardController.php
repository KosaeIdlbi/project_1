<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $admin = Auth::guard("admin")->user();
        return view("admin.dashboard", ["admin" => $admin]);
    }
}
