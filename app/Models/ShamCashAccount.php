<?php

namespace App\Models;

use App\Traits\UserTimeZone;
use Illuminate\Database\Eloquent\Model;

class ShamCashAccount extends Model
{
    use UserTimeZone;
    protected $fillable = ["account_number", "minimum_charge", "maximum_charge"];
    protected $table = "sham_cash_account";
    public function img()
    {
        return $this->morphOne(Img::class, "imgable");
    }
}
