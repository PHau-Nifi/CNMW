<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $table = 'levels';
    protected $fillable = [
        'name',
        'code',	
        'percent',	
        'quantity',	
        'startTime',	
        'endTime',	
        'status'
    ];

    public function discount(){
        return $this->belongsToMany(Discount::class,'discount_level','level_id','discount_id');
    }
    
}
