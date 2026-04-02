<?php

use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get("", function () {
    return view("map");
});
// Route::get("/addRole", function () {
//     $user = User::find(3);
//     $user->assignRole("level_1");

//     $user = Admin::find(3);
//     $user->assignRole("normal");

//     return redirect("/");
// });

Route::get("/404", function () {
    return view("404");
})->name("404");
Route::fallback(function () {
    return view("404");
});
require __DIR__ . "/UserRoutes.php";
require __DIR__ . "/AdminRoutes.php";
