<?php

namespace App\Filament\Resources\AuditTrailResource\Pages;

use App\Filament\Resources\AuditTrailResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkReadAuditTrailPermission;

class ListAuditTrails extends ListRecords
{
    protected static string $resource = AuditTrailResource::class;

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadAuditTrailPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Audit Trail",
            "activity" => "Viewed List Audit Trail Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
