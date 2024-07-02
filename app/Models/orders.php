<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_id';

    protected $fillable =[
        'schedule_id'
        ,'receipt_number'
        ,'amount'
        ,'total_payment'
        ,'no_kursi'
        ,'status_kursi'
        ,'status_pembayaran'
        ,'current_time'
        ,'jam_selesai_film'
    ];

    public function schedule(){
        return $this->belongsTo(MovieSchedule::class,'schedule_id','schedule_id');
    }
}
