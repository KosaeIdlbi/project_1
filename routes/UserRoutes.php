<?php

use App\Http\Controllers\User\AboutUsController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\FavController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\LogoutController;
use App\Http\Controllers\User\Auth\PasswordController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\Auth\VerifyController;
use App\Http\Controllers\User\BrandController;
use App\Http\Controllers\User\CatigoryController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ViewProductsController;
use App\Http\Controllers\User\WalletController;
use Illuminate\Support\Facades\Route;

Route::prefix("user/")->as("user.")->group(function () {
    Route::get('home', HomeController::class)->name("home");
    Route::get('product/{type}/{id}', ProductController::class)->name("product");
    Route::get('about-us', AboutUsController::class)->name("aboutUs");
    Route::get('catigories', CatigoryController::class)->name("ViewCatigories");
    Route::get('brands', BrandController::class)->name("ViewBrands");
    Route::get('products/{ProductName}/{CatigoryName}/{BrandName}/{TagName}/{Newests}/{Special}/{Offers}', ViewProductsController::class)->name("ViewProducts");
});
Route::middleware(["Auth:web"])->prefix("user/")->as("user.")->group(function () {
    Route::post("logout", LogoutController::class)->name("logout");
    Route::get('cart', CartController::class)->name("cart");
    Route::get('fav', FavController::class)->name("fav");
    Route::get('profile', ProfileController::class)->name("profile");
    Route::get("orders", OrderController::class)->name("orders");
});

Route::middleware(["Auth:web", "Verify:web"])->prefix("user/")->as("user.")->group(function () {
    Route::as("wallet.")->group(function () {
        Route::get('wallet', [WalletController::class, "create"])->name("create");
        Route::post('wallet', [WalletController::class, "store"])->name("store");
    });
});


Route::middleware("Guest:web")->prefix("user/")->as("user.")->group(function () {

    Route::view("login-register", "user/auth/login-register")->name("login-register");
    Route::as("register.")->group(function () {
        Route::get("register", [RegisterController::class, "create"])->name("create");
        Route::post("register", [RegisterController::class, "store"])->name("store");
    });

    Route::as("login.")->group(function () {
        Route::get("login", [LoginController::class, "create"])->name("create");
        Route::post("login", [LoginController::class, "store"])->name("store");
    });
});

Route::prefix("user/")->as("user.")->group(function () {
    Route::as("password.")->group(function () {
        Route::get("forget-password", [PasswordController::class, "create"])->name("create");
        Route::post("forget-password", [PasswordController::class, "store"])->middleware("throttle:user-password-reset-links")->name("store");
        Route::get("reset-password/{token}", [PasswordController::class, "edit"])->name("edit");
        Route::patch("reset-password/{token}", [PasswordController::class, "update"])->name("update");
    });
});

Route::middleware(["Auth:web", "NotVerify:web"])->prefix("user/")->as("user.")->group(function () {
    Route::as("verify.")->group(function () {
        Route::get("verify", [VerifyController::class, "edit"])->name("edit");
        Route::patch("verify", [VerifyController::class, "update"])->middleware("throttle:user-verification-links")->name("update");
        Route::get("verify/{token}", [VerifyController::class, "verifyUser"])->name("verifyUser");
    });
});
