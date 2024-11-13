<?php

namespace App\Filament\Resources\UssdGatewayResource\Pages;

use App\Filament\Resources\UssdGatewayResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkCreateUssdGatewayPermission;
use function App\Filament\Resources\checkReadUssdGatewayPermission;

class ListUssdGateways extends ListRecords
{
    protected static string $resource = UssdGatewayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->visible(function(){
                return checkCreateUssdGatewayPermission();
            }),
        ];
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadUssdGatewayPermission(), 403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Ussd Gateway",
            "activity" => "Viewed List Ussd Gateway",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
