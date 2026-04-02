<?php

namespace App\Models;

use App\Traits\UserTimeZone;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CartItem extends Model
{
    use UserTimeZone;
    protected $fillable = ["user_id", "product_id"];
    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
