<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LotteryTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'lottery_id',
        'user_id',
        'rank',
        'status',
        'prize',
    ];

    // public function lottery () {
    //     return $this->belongsTo(Lottery::class);
    // }

    // public function user () {
    //     return $this->belongsTo(User::class);
    // }
       
    public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }

        public function lottery()
        {
            return $this->belongsTo(Lottery::class, 'lottery_id');
        }
}
