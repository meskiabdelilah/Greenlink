<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoucherRedemption extends Model
{
    protected $fillable = [
        'user_id',
        'voucher_id',
        'point_spent',
        'status',
        'redeemed_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    } 
    
    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
