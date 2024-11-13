<?php

namespace App\Filament\Resources\BusinessResource\Pages;

use App\Filament\Resources\BusinessResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkCreateAuditTrailPermission;
use function App\Filament\Resources\checkReadBusinessPermission;

class CreateBusiness extends CreateRecord
{
    protected static string $resource = BusinessResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Business saved successfully';
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadBusinessPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Business",
            "activity" => "Viewed Create Business Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
