<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredMovies extends Model
{
    use HasFactory;
    
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
        'show_start',
        'show_end',
        'deskripsi',
        'status_approval',
        'tanggal_approval'
    ];
}
