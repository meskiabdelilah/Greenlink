<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
        'citizen_id',
        'agent_id',
        'category_id',
        'address',
        'city',
        'estimated_weight',
        'actual_weight',
        'photo_path',
        'collected_at',
        'validated_at',
        'status'
    ];

    public function citizen()
    {
        return $this->belongsTo(User::class, 'citizen_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function category()
    {
        return $this->belongsTo(WasteCategory::class);
    }

    public function pointTransaction()
    {
        return $this->hasOne(PointTransaction::class);
    }
}
