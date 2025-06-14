<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;
    protected $fillable = [
        'referrer_id', // who reffered
        'referred_id', // who joined
    ];

    public function refferer () {
        return $this->belongsTo(User::class, 'referred_id');
    }

    public function referrer ()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    public function referredUser()
    {
        return $this->belongsTo(User::class, 'referred_id');
    }

}
