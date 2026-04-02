<?php

namespace App\Models;

use App\Traits\UserTimeZone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specification extends Model
{
    use UserTimeZone, SoftDeletes;
    protected $fillable = [
        "name",
        "desc",
        "order",
        "product_id",
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
