<?php

namespace App\Filament\Resources\PaymentIntentResource\Pages;

use App\Filament\Resources\PaymentIntentResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkReadPaymentIntentPermission;

class CreatePaymentIntent extends CreateRecord
{
    protected static string $resource = PaymentIntentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadPaymentIntentPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Payment Intent",
            "activity" => "Viewed Create Payment Intent Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
