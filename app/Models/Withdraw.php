<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gateway_id',
        'amount',
        'getable_amount',
        'fee',
        'status',
        'block_reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gateway()
    {
        return $this->belongsTo(WithdrawGateway::class);
    }

    public function fields()
    {
        return $this->hasMany(WithdrawDynamicField::class);
    }
}
