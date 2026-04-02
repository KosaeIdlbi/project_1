<?php

namespace App\Models;

use App\Traits\UserTimeZone;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use UserTimeZone;
    protected $fillable = [
        "user_id",
        "admin_id",
        "amount",
        "transcation_number",
        "charge_status",
        "denied_reason_id",
    ];
    public function img()
    {
        return $this->morphOne(Img::class, "imgable");
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function deniedReason()
    {
        return $this->belongsTo(DeniedReason::class);
    }
}
