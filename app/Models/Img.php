<?php

namespace App\Models;

use App\Traits\UserTimeZone;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Img extends Model
{
    use UserTimeZone;
    protected $fillable = ["path", "imgable_type", "imgable_id"];
    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
    public function imgable()
    {
        return $this->morphTo("imgable", "imgable_type", "imgable_id");
    }
}
