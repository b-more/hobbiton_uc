<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalSms extends Model
{
    use HasFactory;

    protected $fillable = [
        "business_id",
        "sim_account_id",
        "total_sms"
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function sim_account()
    {
        return $this->belongsTo(SimAccount::class);
    }
}
