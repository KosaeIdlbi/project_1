<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\VerifyController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CatigoryController;
use App\Http\Controllers\Admin\ChargerController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

Route::middleware(["Auth:admin", "Verify:admin"])->prefix("admin/")->as("admin.")->group(function () {
    Route::get('/dashboard', DashBoardController::class)->name("dashboard");

    Route::get('/dashboard/charger/view', [ChargerController::class, "chargerView"])->name("chargerView")->middleware("permission:charge_orders,admin");
    Route::get('/dashboard/charger/add-denied-reasons', [ChargerController::class, "chargerAddDeniedReasons"])->name("chargerAddDeniedReasons")->middleware("permission:denied_reasons,admin");
    Route::get('/dashboard/charger/add-shamcash', [ChargerController::class, "chargerAddShamcash"])->name("chargerAddShamcash")->middleware("permission:sham_account,admin");

    Route::get('/dashboard/orders/view', OrdersController::class)->name("ordersView")->middleware("permission:client_orders,admin");

    Route::get('/dashboard/coupons/view', CouponsController::class)->name("couponsView")->middleware("permission:coupons,admin");

    Route::get('/dashboard/catigories/add', [CatigoryController::class, "catigoriesAdd"])->name("catigoriesAdd")->middleware("permission:catigories,admin");
    Route::get('/dashboard/catigories/view', [CatigoryController::class, "catigoriesView"])->name("catigoriesView")->middleware("permission:catigories,admin");

    Route::get('/dashboard/brands/add', [BrandController::class, "brandsAdd"])->name("brandsAdd")->middleware("permission:brands,admin");
    Route::get('/dashboard/brands/view', [BrandController::class, "brandsView"])->name("brandsView")->middleware("permission:brands,admin");

    Route::get('/dashboard/tags/add', [TagController::class, "tagsAdd"])->name("tagsAdd")->middleware("permission:tags,admin");
    Route::get('/dashboard/tags/view', [TagController::class, "tagsView"])->name("tagsView")->middleware("permission:tags,admin");

    Route::get('/dashboard/products/add', [ProductController::class, "productsAdd"])->name("productsAdd")->middleware("permission:products,admin");
    Route::get('/dashboard/products/view', [ProductController::class, "productsView"])->name("productsView")->middleware("permission:products,admin");

    Route::get('/dashboard/employees/SetPermissions', [EmployeeController::class, "employeesSetPermissions"])->name("employeesSetPermissions")->middleware("permission:set_permissions,admin");
    Route::get('/dashboard/employees/SetRoles', [EmployeeController::class, "employeesSetRoles"])->name("employeesSetRoles")->middleware("permission:set_roles,admin");
    Route::get('/dashboard/employees/SetEmployeeRole', [EmployeeController::class, "employeesSetEmployeeRole"])->name("employeesSetEmployeeRole")->middleware("permission:set_employees_roles_permissions,admin");
    Route::get('/dashboard/employees/SetRegisterPassword', [EmployeeController::class, "employeesSetRegisterPassword"])->name("employeesSetRegisterPassword")->middleware("permission:set_register_password,admin");

    Route::get('/dashboard/profile', ProfileController::class)->name("profile");
});



Route::middleware(["Auth:admin"])->prefix("admin/")->as("admin.")->group(function () {
    Route::post("logout", LogoutController::class)->name("logout");
});
Route::middleware("Guest:admin")->prefix("admin/")->as("admin.")->group(function () {

    Route::view("login-register", "admin/auth/login-register")->name("login-register");
    Route::as("register.")->group(function () {
        Route::get("register", [RegisterController::class, "create"])->name("create");
        Route::post("register", [RegisterController::class, "store"])->name("store");
    });

    Route::as("login.")->group(function () {
        Route::get("login", [LoginController::class, "create"])->name("create");
        Route::post("login", [LoginController::class, "store"])->name("store");
    });
});


Route::prefix("admin/")->as("admin.")->group(function () {
    Route::as("password.")->group(function () {
        Route::get("forget-password", [PasswordController::class, "create"])->name("create");
        Route::post("forget-password", [PasswordController::class, "store"])->middleware("throttle:admin-password-reset-links")->name("store");
        Route::get("reset-password/{token}", [PasswordController::class, "edit"])->name("edit");
        Route::patch("reset-password/{token}", [PasswordController::class, "update"])->name("update");
    });
});


Route::middleware(["Auth:admin", "NotVerify:admin"])->prefix("admin/")->as("admin.")->group(function () {
    Route::as("verify.")->group(function () {
        Route::get("verify", [VerifyController::class, "edit"])->name("edit");
        Route::patch("verify", [VerifyController::class, "update"])->middleware("throttle:admin-verification-links")->name("update");
        Route::get("verify/{token}", [VerifyController::class, "verifyUser"])->name("verifyUser");
    });
});
