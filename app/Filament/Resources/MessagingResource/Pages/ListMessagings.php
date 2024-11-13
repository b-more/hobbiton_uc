<?php

namespace App\Filament\Resources\MessagingResource\Pages;

use App\Filament\Resources\MessagingResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkCreateMessagingPermission;
use function App\Filament\Resources\checkReadMessagingPermission;

class ListMessagings extends ListRecords
{
    protected static string $resource = MessagingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Create Message')->visible(function(){
                return checkCreateMessagingPermission();
            }),
        ];
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadMessagingPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Messaging",
            "activity" => "Viewed List Messaging Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
