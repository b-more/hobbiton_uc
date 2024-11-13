<?php

namespace App\Filament\Resources\PaymentIntentResource\Pages;

use App\Filament\Resources\PaymentIntentResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkCreatePaymentIntentPermission;
use function App\Filament\Resources\checkReadPaymentIntentPermission;

class ListPaymentIntents extends ListRecords
{
    protected static string $resource = PaymentIntentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->visible(function (){
                return checkCreatePaymentIntentPermission();
            }),
        ];
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadPaymentIntentPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Payment Intent",
            "activity" => "Viewed List Payment Intent Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
