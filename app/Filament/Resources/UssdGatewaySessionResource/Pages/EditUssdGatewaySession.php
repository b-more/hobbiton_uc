<?php

namespace App\Filament\Resources\UssdGatewaySessionResource\Pages;

use App\Filament\Resources\UssdGatewaySessionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use function App\Filament\Resources\checkDeleteUssdGatewaySessionPermission;

class EditUssdGatewaySession extends EditRecord
{
    protected static string $resource = UssdGatewaySessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->visible(function(){
                return checkDeleteUssdGatewaySessionPermission();
            }),
        ];
    }
}
