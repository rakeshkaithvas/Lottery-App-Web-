<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawGateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'currency',
        'rate',
        'min',
        'max',
        'fee',
        'instruction',
        'status',
    ];

    public function dynamicFields()
    {
        return $this->hasMany(WithdrawGatewayDynamicField::class);
    }
}
