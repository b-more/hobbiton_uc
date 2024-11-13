<?php

namespace App\Models;

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Support\Facades\Auth;

//     class SmsInbox extends Model
//     {
//         protected $fillable = [
//             'sender_number',
//             'message',
//             'serial_number',
//             'incoming_sms_id',
//             'port',
//             'smsc'
//         ];
    
//         protected static function booted()
//         {
//             static::addGlobalScope('business', function (Builder $builder) {
//                 if (Auth::check() && Auth::user()->business_id !== 1) {
//                     $ports = SimAccount::where('business_id', Auth::user()->business_id)
//                         ->where('is_active', true)
//                         ->pluck('port')
//                         ->toArray();
                    
//                     $builder->whereIn('port', $ports);
//                 }
//             });
//         }
        
//         // Allow null or zero values for port
//         public function setPortAttribute($value)
//         {
//             $this->attributes['port'] = is_null($value) ? null : (int)$value;
//         }
        
//         public function user(){
//             return $this->belongsTo(User::class);
//         }
    
//         public function simAccount()
//         {
//             return $this->belongsTo(SimAccount::class, 'port', 'port');
//         }
//     }


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SmsInbox extends Model
{
    protected $fillable = [
        'sender_number',
        'message',
        'serial_number',
        'incoming_sms_id',
        'port',
        'smsc',
        'gateway_ip',    
        'business_id'    
    ];

    protected static function booted()
    {
        static::addGlobalScope('business_gateway', function (Builder $builder) {
            if (Auth::check() && Auth::user()->business_id !== 1) {
                // Get all SIM accounts for this business
                $simAccounts = SimAccount::where('business_id', Auth::user()->business_id)
                    ->where('is_active', true)
                    ->get();

                // Group ports by gateway IP
                $gatewayPorts = $simAccounts->groupBy('gateway_ip')
                    ->map(function ($sims) {
                        return $sims->pluck('port')->toArray();
                    })
                    ->toArray();

                Log::info('Filtering inbox messages', [
                    'business_id' => Auth::user()->business_id,
                    'gateway_ports' => $gatewayPorts
                ]);

                // Build query for each gateway IP and its ports
                $builder->where(function ($query) use ($gatewayPorts) {
                    foreach ($gatewayPorts as $gatewayIp => $ports) {
                        $query->orWhere(function ($q) use ($gatewayIp, $ports) {
                            $q->whereIn('port', $ports);
                        });
                    }
                });
            }
        });
    }

    // Relationship with SimAccount
    public function simAccount()
    {
        return $this->belongsTo(SimAccount::class, 'port', 'port')
            ->where('business_id', Auth::user()->business_id);
    }

    // Helper method to get gateway IP for a port
    public function getGatewayIp()
    {
        return SimAccount::where('port', $this->port)
            ->where('business_id', Auth::user()->business_id)
            ->value('gateway_ip');
    }
}