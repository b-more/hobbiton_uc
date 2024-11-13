<?php

namespace App\Filament\Resources\ContactGroupResource\Pages;

use App\Filament\Resources\ContactGroupResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkReadBusinessPermission;
use function App\Filament\Resources\checkReadContactGroupPermission;

class CreateContactGroup extends CreateRecord
{
    protected static string $resource = ContactGroupResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Contact Group Saved Successfully';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user_id = Auth::user()->id;
        $data['user_id'] = $user_id;

        $business_id = Auth::user()->business_id;
        $data['business_id'] = $business_id;

        return $data;
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadContactGroupPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Contact Group",
            "activity" => "Viewed Create Contact Group Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
