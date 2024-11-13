<?php

namespace App\Filament\Resources\UssdGatewayResource\Pages;

use App\Filament\Resources\UssdGatewayResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkReadUssdGatewayPermission;

class CreateUssdGateway extends CreateRecord
{
    protected static string $resource = UssdGatewayResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadUssdGatewayPermission(), 403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Ussd Gateway",
            "activity" => "Viewed Create Ussd Gateway",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
