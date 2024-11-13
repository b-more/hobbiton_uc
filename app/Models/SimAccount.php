<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Mailer\Transport\Smtp\Auth\AuthenticatorInterface;

class SimAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_provider_id',
        'sms_account_type_id',
        'alphanumeric_id',
        'digital_short_code',
        'business_id',
        'sim_card_number',
        'port',
        'gateway_ip',
        'is_active',
        'created_at',
        'updated_at'
    ];
    public function ServiceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function Business()
    {
        return $this->belongsTo(Business::class);
    }

    public function sms_account_type()
    {
        return $this->belongsTo(SmsAccountType::class);
    }
}
