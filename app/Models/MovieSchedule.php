<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieSchedule extends Model
{
    use HasFactory;

    protected $primaryKey = 'schedule_id';

    protected $fillable = [
        'movie_id',
        'theater_id',
        'show_start',
        'show_end',
        'status_approval',
        'tanggal_approval'
    ];

    public function movie()
    {
        return $this->belongsTo(RegisteredMovies::class, 'movie_id');
    }

    public function theater()
    {
        return $this->belongsTo(Theater::class, 'theater_id');
    }
}
