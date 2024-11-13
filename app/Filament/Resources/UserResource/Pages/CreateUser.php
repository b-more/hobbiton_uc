<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkReadUserPermission;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadUserPermission(), 403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Users",
            "activity" => "Viewed Create Users",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Auth::user();
        if($user->is_client == 1){// client
            $data['business_id']  = $user->business_id;
        }

        return $data;

    }
}
