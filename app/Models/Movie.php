<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'showTime',
        'releaseDate',
        'endDate',
        'national',
        'description',
        'director',
        'cast',
        'trailer',
        'rating_id',
        'status'
    ];

    public function movieGenres()
    {
        return $this->belongsToMany(MovieGenre::class, 'moviegenres_movies', 'movie_id', 'movieGenre_id');
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class, 'rating_id', 'id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'movie_id', 'id');
    }

    public function schedulesByDateAndTheater($date, $theater)
    {
        return $this->schedules()->select('schedules.*', 'theaters.id as theater')
            ->join('rooms', 'rooms.id', '=', 'schedules.room_id')
            ->join('theaters', 'theaters.id', '=', 'rooms.theater_id')
            ->where('date', $date)
            ->where('schedules.status', true)
            ->where('theaters.id', $theater)->get();
    }

    public function schedulesEarlyByTheaterAndDate($date, $theater)
    {
        return $this->schedules()->select('schedules.*', 'theaters.id as theater')
            ->join('rooms', 'rooms.id', '=', 'schedules.room_id')
            ->join('theaters', 'theaters.id', '=', 'rooms.theater_id')
            ->where('date', $date)
            ->where('schedules.early', true)
            ->where('theaters.id', $theater)->get();
    }
}
