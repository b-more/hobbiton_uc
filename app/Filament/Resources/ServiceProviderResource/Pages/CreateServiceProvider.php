<?php

namespace App\Filament\Resources\ServiceProviderResource\Pages;

use App\Filament\Resources\ServiceProviderResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkReadServiceProviderPermission;

class CreateServiceProvider extends CreateRecord
{
    protected static string $resource = ServiceProviderResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadServiceProviderPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Service Provider",
            "activity" => "Viewed Create Service Provider Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}

