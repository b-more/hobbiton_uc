<?php

namespace App\Filament\Resources\SmsInboxResource\Pages;

use App\Filament\Resources\SmsInboxResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkReadSmsInboxPermission;

class CreateSmsInbox extends CreateRecord
{
    protected static string $resource = SmsInboxResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadSmsInboxPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Sms Inbox",
            "activity" => "Viewed Create Sms Inbox Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
