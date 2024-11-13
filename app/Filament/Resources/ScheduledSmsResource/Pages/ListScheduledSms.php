<?php

namespace App\Filament\Resources\ScheduledSmsResource\Pages;

use App\Filament\Resources\ScheduledSmsResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkCreateScheduledSmsPermission;
use function App\Filament\Resources\checkReadScheduledSmsPermission;

class ListScheduledSms extends ListRecords
{
    protected static string $resource = ScheduledSmsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->visible(function(){
                return checkCreateScheduledSmsPermission();
            }),
        ];
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadScheduledSmsPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Scheduled Sms",
            "activity" => "Viewed List Scheduled Sms Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
