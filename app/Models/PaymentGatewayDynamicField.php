<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGatewayDynamicField extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_name',
        'field_type',
    ];

    public function gateway()
    {
        return $this->belongsTo(PaymentGateway::class);
    }
}
