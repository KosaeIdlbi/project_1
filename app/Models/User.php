<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        "email_verified_at",
        "email_verification_token",
        "email_verification_token_expires_at",
        "timezone",
        "balance",
        "charge_id",
    ];
    //لمنع تسريبها api الحقول التي ينبغي ان تكون مخفية عند ارسال البيانات ك 
    //تكون مخفية من العرض عند طباعة اوبجيكت المودل
    protected $hidden = [
        'password',
        'remember_token',
        "email_verification_token",
        "email_verification_token_expires_at"
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        "created_at" => 'datetime',
        "updated_at" => 'datetime',
        "email_verification_token_expires_at" => 'datetime',
        'password' => 'hashed',
        "balance" => "double",
    ];

    public function getEmailVerifiedAtAttribute($value)
    {
        // .بقاعدة البيانات الوقت null واخذنا منه carbon:parse لكن ال carbon object يعطي true
        // لذلك اذا كان هناك حقل نفحص قيمته اذا كانت null ام لا لانحوله الى carbon object الا عندما نتاكد انه ليس null
        if ($value) {
            $EmailVerifiedAt = Carbon::parse($value)->setTimezone($this->timezone);
            return $EmailVerifiedAt;
        }
    }
    public function getCreatedAtAttribute($value)
    {
        $CreatedAt = Carbon::parse($value)->setTimezone($this->timezone);
        return $CreatedAt;
    }
    public function getUpdatedAtAttribute($value)
    {
        $UpdatedAt = Carbon::parse($value)->setTimezone($this->timezone);
        return $UpdatedAt;
    }
    public function getEmailVerificationTokenExpiresAtAttribute($value)
    {
        $EmailVerificationTokenExpiresAt = Carbon::parse($value)->setTimezone($this->timezone);
        return $EmailVerificationTokenExpiresAt;
    }
    public function favItems()
    {
        return $this->hasMany(FavItem::class);
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function charges()
    {
        return $this->hasMany(Charge::class);
    }
    public function img()
    {
        return $this->morphOne(Img::class, "imgable");
    }
}
