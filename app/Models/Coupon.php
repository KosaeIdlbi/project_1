<?php

namespace App\Models;

use App\Traits\UserTimeZone;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use UserTimeZone;
    protected $fillable = ["code", "discount", "expire_at"];
    public function getExpireAtAttribute($value)
    {
        $expire_at = $this->convertToUserTimeZone($value);
        return $expire_at;
    }
}
