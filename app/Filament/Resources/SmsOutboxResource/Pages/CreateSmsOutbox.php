<?php

namespace App\Filament\Resources\SmsOutboxResource\Pages;

use App\Filament\Resources\SmsOutboxResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkReadSmsOutboxPermission;

class CreateSmsOutbox extends CreateRecord
{
    protected static string $resource = SmsOutboxResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadSmsOutboxPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Sms Outbox",
            "activity" => "Viewed Create Sms Outbox Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
