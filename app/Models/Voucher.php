<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
        protected $fillable = [
        'title',
        'description',
        'points_required',
        'stock'
    ];

    public function redemptions()
    {
        return $this->hasMany(VoucherRedemption::class);
    }
}
