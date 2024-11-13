<?php

namespace App\Filament\Widgets;

use App\Models\SimAccount;
use App\Models\SmsInbox;
use App\Models\SmsOutbox;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SmsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $inbox_count = 0;
        $outbox_count = 0;
        $number_of_ports = 0;
        if(Auth::user()->business_id == 1){
            $inbox_count = DB::table('sms_inboxes')->count();
            $outbox_count = DB::table('sms_outboxes')->count();
        }else{
            $port=SimAccount::where('business_id', Auth::user()->business_id)->first()->port ?? 0;
            $sender_number=SimAccount::where('business_id', Auth::user()->business_id)->first()->sim_card_number ?? 0;
            $inbox_count = SmsInbox::where('port',$port)->count();
            $outbox_count = SmsOutbox::where('sender_number',$sender_number)->count();
            $number_of_ports = SimAccount::where('business_id',Auth::user()->business_id)->count();
        }
       
        return [
            Stat::make('SMS Inbox', $inbox_count)
            ->description('Increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
            Stat::make('SMS Outbox', $outbox_count)
            ->description('Increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('info'),
            Stat::make('SMS Sending Failed', $number_of_ports)
            ->description('Increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('danger'),
        ];
    }
}
