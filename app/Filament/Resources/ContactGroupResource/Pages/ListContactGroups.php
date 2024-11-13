<?php

namespace App\Filament\Resources\ContactGroupResource\Pages;

use App\Filament\Resources\ContactGroupResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkCreateContactGroupPermission;
use function App\Filament\Resources\checkReadContactGroupPermission;

class ListContactGroups extends ListRecords
{
    protected static string $resource = ContactGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->visible(function (){
                return checkCreateContactGroupPermission();
            }),
        ];
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadContactGroupPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Contact Group",
            "activity" => "Viewed List Contact Group Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
