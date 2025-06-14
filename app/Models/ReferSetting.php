<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'joining_bonus',
        'joining_bonus_amount',
        'deposit_bonus',
        'deposit_percentage',
    ];
}
