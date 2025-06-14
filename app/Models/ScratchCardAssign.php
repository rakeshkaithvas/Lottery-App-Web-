<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScratchCardAssign extends Model
{
    protected $fillable = [
        'normal_user_scan_qr_id',
        'verified_user_id',
        'scratch_id',
        'status',
    ];

  public function scratch()
    {
        return $this->belongsTo(Scratch::class, 'scratch_id');
    }  

    // ScratchCardAssign.php
    public function normalUser()
    {
        return $this->belongsTo(User::class, 'normal_user_scan_qr_id');
    }
}
?>