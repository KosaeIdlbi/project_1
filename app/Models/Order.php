<?php

namespace App\Models;

use App\Traits\UserTimeZone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use UserTimeZone, SoftDeletes;
    protected $fillable = [
        "user_id",
        "admin_id",
        "coupon",
        "product_name",
        "single_price",
        "quantity",
        "total_price",
        "sub_total",
        "order_price",
        "address",
        "phone",
        "notes",
        "order_status",
    ];
    protected $casts = [
        "coupon" => "collection",
        "product_name" => "collection",
        "single_price" => "collection",
        "quantity" => "collection",
        "total_price" => "collection",
        "sub_total" => "double",
        "order_price" => "double",
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
