<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Catigory;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catigories = Catigory::get();
        foreach ($catigories as $catigory) {
            $catigory->img()->create([
                "path" => "img12.jpg"
            ]);
        }

        $brands = Brand::get();
        foreach ($brands as $brand) {
            $brand->img()->create([
                "path" => "img12.jpg"
            ]);
        }

        $products = Product::get();
        foreach ($products as $product) {
            $product->imgs()->create([
                "path" => "img12.jpg"
            ]);
            $product->imgs()->create([
                "path" => "img12.jpg"
            ]);
            $product->imgs()->create([
                "path" => "img12.jpg"
            ]);
            $product->imgs()->create([
                "path" => "img12.jpg"
            ]);
            $product->imgs()->create([
                "path" => "img12.jpg"
            ]);
        }
    }
}
