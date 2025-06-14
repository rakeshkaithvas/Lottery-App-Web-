<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'gateway_id',
        'trx_id',
        'amount',
        'total_amount',
        'fee',
        'screenshot',
        'user_id',
        'status',
        'block_reason',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function gateway ()
    {
        return $this->belongsTo(PaymentGateway::class);
    }

    public function fields()
    {
        return $this->hasMany(PaymentDynamicField::class);
    }
}
