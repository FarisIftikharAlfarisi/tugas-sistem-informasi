<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredMovies extends Model
{
    use HasFactory;

    protected $tables = 'registered_movies';
    protected $primaryKey = 'movie_id';

    protected $fillable = [
        'poster',
        'judul',
        'sutradara',
        'produser',
        'bahasa',
        'bahasa_subtitle',
        'genre',
        'sensor',
        'harga',
        'deskripsi',
        'rating',
        'durasi',
        'status_approval',
        'tanggal_approval'
    ];

    public function schedules()
    {
        return $this->hasMany(MovieSchedule::class, 'movie_id');
    }
}
