<?php

namespace App\Filament\Resources\SimAccountResource\Pages;

use App\Filament\Resources\SimAccountResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkReadSimAccountPermission;

class CreateSimAccount extends CreateRecord
{
    protected static string $resource = SimAccountResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadSimAccountPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Sim Accounts",
            "activity" => "Viewed Create Sim Accounts Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
