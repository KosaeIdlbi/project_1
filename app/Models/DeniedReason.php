<?php

namespace App\Models;

use App\Traits\UserTimeZone;
use Illuminate\Database\Eloquent\Model;

class DeniedReason extends Model
{
    use UserTimeZone;
    protected $fillable = ["name", "desc"];
    public function charges()
    {
        return $this->hasMany(Charge::class);
    }
}
