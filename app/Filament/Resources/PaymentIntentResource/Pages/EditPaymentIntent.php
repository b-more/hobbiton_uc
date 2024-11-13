<?php

namespace App\Filament\Resources\PaymentIntentResource\Pages;

use App\Filament\Resources\PaymentIntentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use function App\Filament\Resources\checkDeletePaymentIntentPermission;

class EditPaymentIntent extends EditRecord
{
    protected static string $resource = PaymentIntentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->visible(function (){
                return checkDeletePaymentIntentPermission();
            }),
        ];
    }
}
