<?php

namespace App\Filament\Widgets;

// namespace App\Filament\Widgets;

// use App\Models\SmsOutbox;
// use App\Models\SmsInbox;
// use App\Models\SimAccount;
// use Filament\Widgets\StatsOverviewWidget as BaseWidget;
// use Filament\Widgets\StatsOverviewWidget\Stat;
// use Illuminate\Support\Facades\Auth;

// class SmsStatsWidget extends BaseWidget
// {
//     protected static ?string $pollingInterval = '15s';

//     protected function getStats(): array
//     {
//         $businessId = Auth::user()->business_id;
        
//         // Get business-specific SIM numbers and ports
//         $simAccounts = SimAccount::where('business_id', $businessId)
//             ->where('is_active', true)
//             ->get();
        
//         $simNumbers = $simAccounts->pluck('sim_card_number');
//         $ports = $simAccounts->pluck('port');

//         // Get outbox stats
//         $outboxTotal = SmsOutbox::whereIn('sender_number', $simNumbers)
//             ->whereDate('created_at', today())
//             ->count();

//         $outboxSuccess = SmsOutbox::whereIn('sender_number', $simNumbers)
//             ->whereDate('created_at', today())
//             ->where('status', true)
//             ->count();

//         // Get inbox stats
//         $inboxTotal = SmsInbox::whereIn('port', $ports)
//             ->whereDate('created_at', today())
//             ->count();

//         return [
//             Stat::make('Sent Today', $outboxTotal)
//                 ->description($outboxSuccess . ' delivered')
//                 ->descriptionIcon('heroicon-m-paper-airplane')
//                 ->color('success'),

//             Stat::make('Received Today', $inboxTotal)
//                 ->description('Via ' . $simAccounts->count() . ' SIM(s)')
//                 ->descriptionIcon('heroicon-m-inbox')
//                 ->color('primary'),

//             Stat::make('Active SIMs', $simAccounts->count())
//                 ->description('Connected to gateway')
//                 ->descriptionIcon('heroicon-m-signal')
//                 ->color('info'),
//         ];
//     }
// }



use App\Models\SimAccount;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class GatewayStatusWidget extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        $stats = [];
        
        $gateways = SimAccount::where('business_id', Auth::user()->business_id)
            ->where('is_active', true)
            ->get()
            ->groupBy('gateway_ip');

        foreach ($gateways as $ip => $sims) {
            // Test gateway connection
            $connection = @fsockopen($ip, 443, $errno, $errstr, 5);
            $isConnected = (bool)$connection;
            if ($connection) {
                fclose($connection);
            }

            $stats[] = Stat::make("UC2000 ({$ip})")
                ->value($sims->count() . ' ports')
                ->description($isConnected ? 'Connected' : 'Connection Failed')
                ->descriptionIcon($isConnected ? 'heroicon-s-signal' : 'heroicon-s-x-circle')
                ->color($isConnected ? 'success' : 'danger');
        }

        return $stats;
    }
}