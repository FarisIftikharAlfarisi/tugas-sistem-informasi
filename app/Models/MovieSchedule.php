<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieSchedule extends Model
{
    use HasFactory;

    protected $table = 'movie_schedules';

    protected $primaryKey = 'schedule_id';

    protected $dates = ['show_start','show_end'];

    protected $fillable = [
        'movies_id',
        'theaters_id',
        'show_start',
        'show_end',
        'status_approval',
        'tanggal_approval'
    ];

    public function movie()
    {
        return $this->belongsTo(RegisteredMovies::class, 'movies_id', 'movie_id');
    }

    public function theater()
    {
        return $this->belongsTo(Theater::class, 'theaters_id', 'theater_id');
    }

    public function order(){
        return $this->hasMany(Orders::class,'schedule_id','schedule_id');
    }
}
