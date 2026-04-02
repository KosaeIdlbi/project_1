<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productsView()
    {
        $admin = Auth::guard("admin")->user();
        return view("admin.products.view", ["admin" => $admin]);
    }
    public function productsAdd()
    {
        $admin = Auth::guard("admin")->user();
        return view("admin.products.add", ["admin" => $admin]);
    }
}
