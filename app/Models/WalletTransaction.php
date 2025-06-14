<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WalletTransaction extends Model
{
    use HasFactory;
    protected $table = 'wallettransaction'; // <-- Add this line
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'amount',
        'inv_amount',
        'type',
        'comments',
        'status',
        'note',
    ];


    protected $casts = [
    'id' => 'integer',
    'sender_id' => 'integer',
    'receiver_id' => 'integer',
    'amount' => 'float',
    'inv_amount' => 'float',
];

      // Relationship: Sender user
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relationship: Receiver user
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
