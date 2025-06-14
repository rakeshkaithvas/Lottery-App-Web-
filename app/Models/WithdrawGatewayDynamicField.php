<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawGatewayDynamicField extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_name',
        'field_type',
        'withdraw_gateway_id',
    ];

    public function gateway()
    {
        return $this->belongsTo(PaymentGateway::class, 'deposit_gateway_id');
    }
}
