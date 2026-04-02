<?php

namespace App\Providers;

use App\Models\Charge;
use App\Models\Order;
use App\Models\Product;
use App\Observers\ChargeObserver;
use App\Observers\OrderObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Product::observe(ProductObserver::class);
        Order::observe(OrderObserver::class);
        Charge::observe(ChargeObserver::class);
    }
}
