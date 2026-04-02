<?php

namespace App\Models;

use App\Traits\TimeZone;
use App\Traits\UserTimeZone;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use UserTimeZone, SoftDeletes;
    protected $fillable = [
        "name",
        "desc",
        "price",
        "quantity",
        "able_to_buy_quantity",
        "catigory_id",
        "tag_id",
        "brand_id",
        "available",
        "special",
        "has_offer",
        "offer_ends_at",
        "offer_price",
        "is_newest"
    ];
    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "price" => "double",
        "quantity" => "double",
        "able_to_buy_quantity" => "double",
        "offer_ends_at" => "datetime",
        "offer_price" => "double",
    ];

    public function getOfferEndsAtAttribute($value)
    {
        if ($value) {
            $OfferEndsAt = $this->convertToUserTimeZone($value);
            return $OfferEndsAt;
        }
    }
    public function getIsNewestAttribute()
    {
        if (Carbon::parse($this->created_at)->diffInDays(now()) > 30) {
            return false;
        } else {
            return true;
        }
    }
    public static function getProductsWithFilters($Price = null, $CatigoryName = "", $BrandName = "", $TagName = "", $ProductName = "", $Available = "", $Special = "", $Offers = "", $UnAvailable = "", $NotSpecial = "", $WithoutOffers = "", $CreatedAt = "2000/1/1 00:00:00", $UpdatedAt = "2000/1/1 00:00:00", $sortAs = "desc",)
    {
        if ($Price) {
            return Product::with(["imgs", "catigory", "brand", "tag", "specifications"])->whereHas("catigory", function ($query) use ($CatigoryName) {
                $query->where("name", "like", "%" . $CatigoryName . "%");
            })->whereHas("brand", function ($query) use ($BrandName) {
                $query->where("name", "like", "%" . $BrandName . "%");
            })->whereHas("tag", function ($query) use ($TagName) {
                $query->where("name", "like", "%" . $TagName . "%");
            })->where("name", "like", "%" . $ProductName . "%")
                ->where("available", "like", "%" . $Available . "%")
                ->where("special", "like", "%" . $Special . "%")
                ->where("has_offer", "like", "%" . $Offers . "%")
                ->where("available", "like", "%" . $UnAvailable . "%")
                ->where("special", "like", "%" . $NotSpecial . "%")
                ->where("has_offer", "like", "%" . $WithoutOffers . "%")
                ->where("created_at", ">=", Carbon::parse($CreatedAt))->orderBy("created_at", $sortAs)
                ->where("updated_at", ">=", Carbon::parse($UpdatedAt))->orderBy("updated_at", $sortAs)
                ->where("price", '<=', $Price)->orderBy("price", "desc")
                ->simplePaginate(9);
        } else {
            return Product::with(["imgs", "catigory", "brand", "tag", "specifications"])->whereHas("catigory", function ($query) use ($CatigoryName) {
                $query->where("name", "like", "%" . $CatigoryName . "%");
            })->whereHas("brand", function ($query) use ($BrandName) {
                $query->where("name", "like", "%" . $BrandName . "%");
            })->whereHas("tag", function ($query) use ($TagName) {
                $query->where("name", "like", "%" . $TagName . "%");
            })->where("name", "like", "%" . $ProductName . "%")
                ->where("available", "like", "%" . $Available . "%")
                ->where("special", "like", "%" . $Special . "%")
                ->where("has_offer", "like", "%" . $Offers . "%")
                ->where("available", "like", "%" . $UnAvailable . "%")
                ->where("special", "like", "%" . $NotSpecial . "%")
                ->where("has_offer", "like", "%" . $WithoutOffers . "%")
                ->where("created_at", ">=", Carbon::parse($CreatedAt))->orderBy("created_at", $sortAs)
                ->where("updated_at", ">=", Carbon::parse($UpdatedAt))->orderBy("updated_at", $sortAs)
                ->simplePaginate(9);
        }
    }
    public function imgs()
    {
        return $this->morphMany(Img::class, "imgable", "imgable_type", "imgable_id");
    }
    public function catigory()
    {
        return $this->belongsTo(Catigory::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
    public function favItems()
    {
        return $this->hasMany(FavItem::class);
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    public function specifications()
    {
        return $this->hasMany(Specification::class);
    }
}
