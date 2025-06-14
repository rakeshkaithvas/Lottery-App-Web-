<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'user_id', 'contact_id', 'lottery_id'
    ];

    // Optional: Define relationships
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contact()
    {
        return $this->belongsTo(User::class, 'contact_id');
    }

    public function lottery()
    {
        return $this->belongsTo(Lottery::class);
    }
}
?>