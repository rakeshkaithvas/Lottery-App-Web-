<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{
    use HasFactory;
    protected $fillable = [
        'created_by',
        'name',
        'lottery_image',
        'price',
        'total_ticket',
        'status',
        'type',
        'total_winner',
        'winner_bonuses',
        'start_date',
        'draw_date',
    ];

     // Cast winner_bonuses JSON to array automatically
    protected $casts = [
        'winner_bonuses' => 'array',
        'start_date' => 'date',
        'draw_date' => 'date',
    ];


    // Define the relationship with LotteryTicket model
    public function lotteryTickets()
    {
        return $this->hasMany(LotteryTicket::class);
    }

    // Relationship with User (creator of the lottery)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function lottery()
{
    return $this->belongsTo(Lottery::class, 'lottery_id');
}

   
}
