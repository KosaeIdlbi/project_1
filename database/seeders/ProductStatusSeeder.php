<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::get();
        for ($i = 0; $i < $products->count(); $i++) {
            if ($i < 50) {
                $products[$i]->updateQuietly([
                    "created_at" => now()->subDays(50),
                    "special" => 1
                ]);
            } elseif ($i >= 50 && $i < 70) {
                $products[$i]->updateQuietly([
                    "created_at" => now()->subDays(50),
                    "special" => 1,
                    "has_offer" => 1,
                    "offer_price" => round($products[$i]->price - $products[$i]->price / 3),
                ]);
            } elseif ($i >= 70 && $i < 100) {
                $products[$i]->updateQuietly([
                    "created_at" => now()->subDays(50),
                    "has_offer" => 1,
                    "offer_price" => round($products[$i]->price - $products[$i]->price / 3),
                ]);
            } elseif ($i >= 100 && $i < 150) {
                $products[$i]->updateQuietly([
                    "special" => 1
                ]);
            } elseif ($i >= 150 && $i < 170) {
                $products[$i]->updateQuietly([
                    "special" => 1,
                    "has_offer" => 1,
                    "offer_price" => round($products[$i]->price - $products[$i]->price / 3),
                ]);
            } elseif ($i >= 170 && $i < 200) {
                $products[$i]->updateQuietly([
                    "has_offer" => 1,
                    "offer_price" =>  round($products[$i]->price - $products[$i]->price / 3),
                ]);
            } elseif ($i >= 200 && $i < 400) {
                $products[$i]->updateQuietly([
                    "created_at" => now()->subDays(50),
                ]);
            }
        }
    }
}
