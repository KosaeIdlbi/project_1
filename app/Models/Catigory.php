<?php

namespace App\Models;

use App\Traits\UserTimeZone;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Catigory extends Model
{
    use UserTimeZone;
    protected $fillable = ["name", "order", "available"];
    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function img()
    {
        return $this->morphOne(Img::class, "imgable");
    }
}
