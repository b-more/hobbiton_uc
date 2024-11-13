<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledSms extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_number',
        'receipient',
        'message',
        'status',
        'user_id',
        'schedule_date',
        'schedule_time'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'status'=> 'boolean'
    ];
}
