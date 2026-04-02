<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function tagsView()
    {
        $admin = Auth::guard("admin")->user();
        return view("admin.tags.view", ["admin" => $admin]);
    }
    public function tagsAdd()
    {
        $admin = Auth::guard("admin")->user();
        return view("admin.tags.add", ["admin" => $admin]);
    }
}
