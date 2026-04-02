<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Catigory;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $user = (Auth::guard("web")->check()) ? Auth::guard("web")->user() : null;
        $catigories = Catigory::orderBy("order", "desc")->take(5)->get();

        $offers = Product::with("imgs")
            ->where("has_offer", 1)
            ->inRandomOrder()
            ->take(10)
            ->get();

        $specials = Product::with("imgs")
            ->where("has_offer", 0)
            ->where("special", 1)
            ->inRandomOrder()
            ->take(10)
            ->get();

        $newests = Product::with("imgs")
            ->orderBy("created_at", "desc")
            ->where("has_offer", 0)
            ->where("special", 0)
            ->where("created_at", ">", now()->subDays(30))
            ->take(10)
            ->get();

        return view("user.home", [
            "catigories" => $catigories,
            "user" => $user,
            "offers" => $offers,
            "specials" => $specials,
            "newests" => $newests,
        ]);
    }
}
