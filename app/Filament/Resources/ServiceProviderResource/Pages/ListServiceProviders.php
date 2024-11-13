<?php

namespace App\Filament\Resources\ServiceProviderResource\Pages;

use App\Filament\Resources\ServiceProviderResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkCreateServiceProviderPermission;
use function App\Filament\Resources\checkReadServiceProviderPermission;

class ListServiceProviders extends ListRecords
{
    protected static string $resource = ServiceProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->visible(function(){
                return checkCreateServiceProviderPermission();
            }),
        ];
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadServiceProviderPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Service Provider",
            "activity" => "Viewed List Service Provider Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
