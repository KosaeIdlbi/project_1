<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewProductsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($ProductName = "", $CatigoryName = "", $BrandName = "", $TagName = "", $Newests = "", $Special = "", $Offers = "")
    {
        if ($ProductName == "none") {
            $ProductName = "";
        }
        if ($CatigoryName == "all") {
            $CatigoryName = "";
        }
        if ($BrandName == "all") {
            $BrandName = "";
        }
        if ($TagName == "all") {
            $TagName = "";
        }
        if ($Newests == "none") {
            $Newests = "";
        }
        if ($Offers == "none") {
            $Offers = "";
        }
        if ($Special == "none") {
            $Special = "";
        }
        $user = (Auth::guard("web")->check()) ? Auth::guard("web")->user() : null;
        return view("user.products", [
            "user" => $user,
            "ProductName" => $ProductName,
            "CatigoryName" => $CatigoryName,
            "BrandName" => $BrandName,
            "TagName" => $TagName,
            "Newests" => $Newests,
            "Offers" => $Offers,
            "Special" => $Special
        ]);
    }
}
