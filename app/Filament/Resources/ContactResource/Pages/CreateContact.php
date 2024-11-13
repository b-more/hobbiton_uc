<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkReadContactPermission;

class CreateContact extends CreateRecord
{
    protected static string $resource = ContactResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Contact saved successfully';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user_id = Auth::user()->id;
        $data['user_id'] = $user_id;


        return $data;
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadContactPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Contacts",
            "activity" => "Viewed Create Contacts Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
