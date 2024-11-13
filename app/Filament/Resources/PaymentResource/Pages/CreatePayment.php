<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkReadPaymentPermission;

class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
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
        abort_unless(checkReadPaymentPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Payments",
            "activity" => "Viewed Create Payments Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
