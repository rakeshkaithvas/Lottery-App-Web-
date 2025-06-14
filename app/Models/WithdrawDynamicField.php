<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawDynamicField extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_name',
        'field_value',
        'withdraw_id',
    ];

    public function gateway()
    {
        return $this->belongsTo(Withdraw::class);
    }
}
