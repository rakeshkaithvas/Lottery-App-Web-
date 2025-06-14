<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'logo',
        'type',
        'fee',
        'min',
        'max',
        'currency',
        'rate',
        'instruction',
        'status',
    ];


    public function data()
    {
        return $this->hasMany(GatewayFileds::class);
    }

    public function dynamicFields()
    {
        return $this->hasMany(PaymentGatewayDynamicField::class);
    }

}
