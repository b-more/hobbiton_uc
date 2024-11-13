<?php

namespace App\Filament\Resources\BusinessResource\Pages;

use App\Filament\Resources\BusinessResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkCreateBusinessPermission;
use function App\Filament\Resources\checkReadAuditTrailPermission;
use function App\Filament\Resources\checkReadBusinessPermission;

class ListBusinesses extends ListRecords
{
    protected static string $resource = BusinessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(function (){
                    return checkCreateBusinessPermission();
                }),
        ];
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadBusinessPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Businesses",
            "activity" => "Viewed List Businesses Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
