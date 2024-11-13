<?php

namespace App\Filament\Resources\SmsAccountTypeResource\Pages;

use App\Filament\Resources\SmsAccountTypeResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkReadSmsAccountTypePermission;

class CreateSmsAccountType extends CreateRecord
{
    protected static string $resource = SmsAccountTypeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadSmsAccountTypePermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Sms Account Type",
            "activity" => "Viewed Create Sms Account Type Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
