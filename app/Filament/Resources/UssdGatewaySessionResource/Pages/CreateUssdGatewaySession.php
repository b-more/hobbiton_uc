<?php

namespace App\Filament\Resources\UssdGatewaySessionResource\Pages;

use App\Filament\Resources\UssdGatewaySessionResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkReadUssdGatewaySessionPermission;

class CreateUssdGatewaySession extends CreateRecord
{
    protected static string $resource = UssdGatewaySessionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadUssdGatewaySessionPermission(), 403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Ussd Gateway Session",
            "activity" => "Viewed Create Ussd Gateway Session",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
