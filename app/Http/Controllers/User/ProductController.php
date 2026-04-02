<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($type, $id)
    {
        $product = Product::with(["imgs", "catigory", "brand", "tag", "specifications" => function ($q) {
            $q->orderBy("order", "asc");
        }])->findOrFail($id);
        $user = (Auth::guard("web")->check()) ? Auth::guard("web")->user() : null;
        $similar_products = Product::with("imgs")->whereHas("tag", function ($q) use ($product) {
            $q->where("name", $product->tag->name);
        })->where("id", "!=", $id)->take(10)->orderBy("created_at", "desc")->get();
        return view("user.product-details", ["type" => $type, "product" => $product, "user" => $user, "similar_products" => $similar_products]);
    }
}
