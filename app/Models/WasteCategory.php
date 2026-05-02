<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WasteCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'points_per_kg',
        'co2_saved_per_kg',
    ];

    public function deposits()
    {
        return $this->hasMany(Deposit::class, 'category_id');
    }
}
