<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function brandsView()
    {
        $admin = Auth::guard("admin")->user();
        return view("admin.brands.view", ["admin" => $admin]);
    }
    public function brandsAdd()
    {
        $admin = Auth::guard("admin")->user();
        return view("admin.brands.add", ["admin" => $admin]);
    }
}
