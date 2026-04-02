<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChargerController extends Controller
{
    public function chargerView()
    {
        $admin = Auth::guard("admin")->user();
        return view("admin.charger.view", ["admin" => $admin]);
    }
    public function chargerAddDeniedReasons()
    {
        $admin = Auth::guard("admin")->user();
        return view("admin.charger.add-denied-reasons", ["admin" => $admin]);
    }
    public function chargerAddShamcash()
    {
        $admin = Auth::guard("admin")->user();
        return view("admin.charger.add-shamcash", ["admin" => $admin]);
    }
}
