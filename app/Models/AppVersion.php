<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'android_app_version',
        'android_app_link',
        'ios_app_version',
        'ios_app_link',
    ];
}
