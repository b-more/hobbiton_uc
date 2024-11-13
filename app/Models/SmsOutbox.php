<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class SmsOutbox extends Model
{
    protected $fillable = [
        'sender_number',
        'receipient',
        'message',
        'status',
        'user_id',
        'response_data'
    ];

    protected $casts = [
        'status' => 'boolean',
        'response_data' => 'array'
    ];

    protected static function booted()
    {
        static::addGlobalScope('business', function (Builder $builder) {
            if (Auth::check() && Auth::user()->business_id !== 1) {
                $simNumbers = SimAccount::query()
                    ->where('business_id', Auth::user()->business_id)
                    ->where('is_active', true)
                    ->pluck('sim_card_number')
                    ->toArray();
                
                $builder->whereIn('sender_number', $simNumbers);
            }
        });
    }

    public function simAccount()
    {
        return $this->belongsTo(SimAccount::class, 'sender_number', 'sim_card_number');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}