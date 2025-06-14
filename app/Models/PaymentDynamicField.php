<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDynamicField extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_name',
        'field_value',
        'deposit_id',
    ];

    public function gateway()
    {
        return $this->belongsTo(Withdraw::class);
    }
}
