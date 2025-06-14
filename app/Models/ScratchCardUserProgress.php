<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScratchCardUserProgress extends Model
{
    protected $fillable = [
        'user_id',
        'scratch_id',
        'scratch_date',
        'scratched_today',
        'total_scratched',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scratch()
    {
        return $this->belongsTo(Scratch::class);
    }
}
?>