<?php

namespace App\Filament\Resources\UssdSessionResource\Pages;

use App\Filament\Resources\UssdSessionResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkReadUssdSessionPermission;

class CreateUssdSession extends CreateRecord
{
    protected static string $resource = UssdSessionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadUssdSessionPermission(), 403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Ussd Session",
            "activity" => "Viewed Create Ussd Session",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
