<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait UserTimeZone
{
    public function convertToUserTimeZone($value)
    {
        $guard = (Auth::guard("web")->check()) ? "web" : "admin";
        $timezone = "";
        if (Auth::guard($guard)->user()) {
            $timezone = Carbon::parse($value)->setTimezone(Auth::guard($guard)->user()->timezone);
        } else {
            $timezone = Carbon::parse($value)->setTimezone("Asia/Damascus");
        }
        return $timezone;
    }
    public function getCreatedAtAttribute($value)
    {
        $CreatedAt = $this->convertToUserTimeZone($value);
        return $CreatedAt;
    }
    public function getUpdatedAtAttribute($value)
    {
        $UpdatedAt = $this->convertToUserTimeZone($value);
        return $UpdatedAt;
    }
}
