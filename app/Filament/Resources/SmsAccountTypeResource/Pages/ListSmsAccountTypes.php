<?php

namespace App\Filament\Resources\SmsAccountTypeResource\Pages;

use App\Filament\Resources\SmsAccountTypeResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkCreateSmsAccountTypePermission;
use function App\Filament\Resources\checkReadSmsAccountTypePermission;

class ListSmsAccountTypes extends ListRecords
{
    protected static string $resource = SmsAccountTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->visible(function(){
                return checkCreateSmsAccountTypePermission();
            }),
        ];
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadSmsAccountTypePermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Sms Account Type",
            "activity" => "Viewed List Sms Account Type Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
