<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scratch extends Model
{
    use HasFactory;
    protected $fillable = [
        'created_by',
        'no_cards',
        'gift',
        'status',
    ];

    // Relationship with User (creator of the lottery)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
