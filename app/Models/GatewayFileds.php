<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GatewayFileds extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'field_name', 'field_value', 'payment_gateway_id'];
}
