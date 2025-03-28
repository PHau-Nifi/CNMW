<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'location',
        'status'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'theater_id', 'id');
    }

}
