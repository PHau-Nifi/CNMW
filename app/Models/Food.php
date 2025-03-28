<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    
    protected $table = 'foods';
    protected $fillable = [
        'name',
        'image',
        'price',
        'status'
    ];

    public function combos()
    {
        return $this->belongsToMany(Combo::class, 'combo_details', 'food_id', 'combo_id');
    }
}
