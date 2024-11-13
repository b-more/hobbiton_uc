<?php

namespace App\Filament\Resources\TotalSmsResource\Pages;

use App\Filament\Resources\TotalSmsResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkReadTotalSmsPermission;

class CreateTotalSms extends CreateRecord
{
    protected static string $resource = TotalSmsResource::class;

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadTotalSmsPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Total Sms",
            "activity" => "Viewed Create Total Sms Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
