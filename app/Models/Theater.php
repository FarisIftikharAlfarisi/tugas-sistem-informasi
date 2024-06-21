<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    use HasFactory;

    protected $tables = 'theaters';
    protected $primaryKey = 'theater_id';

    protected $fillable = [
        'nama_theater',
        'status_availability'
    ];

    public function schedules()
    {
        return $this->hasMany(MovieSchedule::class, 'theater_id');
    }

}
