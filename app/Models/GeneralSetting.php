<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = [
        'id',
        'user_registration',
        'email_verification',
        'maintenance_mode',
        'maintenance_message',
        'currency',
        'currency_symbol',
    ];
    use HasFactory;
}
