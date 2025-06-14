<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogoFaviconSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'id',
        'fav_icon',
    ];
}
