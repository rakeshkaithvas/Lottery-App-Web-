<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status',
        'user_status',
        'block_reason',
        'balance',
        'user_image',
        'user_document',
        'user_qr',
        'otp',
        'refer_code',
        'otp_verified',
        'otp_expiry',
        'date_of_birth',
        'profile_picture',
        'fcm_token',
        'shop_name',
        'shop_image',
        'shop_category',
        'shop_address',
        'discount',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function referrals()
    {
        return $this->hasMany(Referral::class, 'referrer_id');
    }

    public function referred()
    {
        return $this->hasOne(Referral::class, 'referred_id');
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdraw::class);
    }

    public function lotteryTickets()
    {
        return $this->hasMany(LotteryTicket::class);
    }

        public function lotteries()
    {
        return $this->hasMany(\App\Models\Lottery::class, 'created_by');
    }
}
