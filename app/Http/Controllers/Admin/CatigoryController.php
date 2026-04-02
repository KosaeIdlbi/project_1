<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatigoryController extends Controller
{
    public function catigoriesView()
    {
        $admin = Auth::guard("admin")->user();
        return view("admin.catigories.view", ["admin" => $admin]);
    }
    public function catigoriesAdd()
    {
        $admin = Auth::guard("admin")->user();
        return view("admin.catigories.add", ["admin" => $admin]);
    }
}
