<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = (Auth::guard("web")->check()) ? Auth::guard("web")->user() : null;
        $brands = Brand::orderBy("order", "desc")->get();
        return view("user.brands", ["brands" => $brands, "user" => $user]);
    }
}
