<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'percent',
        'quantity',
        'startTime',
        'endTime',
        'status'
    ];

    public function level(){
        return $this->belongsToMany(Level::class,'discount_level','discount_id','level_id');
    }

}
