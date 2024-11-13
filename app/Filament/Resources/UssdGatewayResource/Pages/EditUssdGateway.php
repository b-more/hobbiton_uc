<?php

namespace App\Filament\Resources\UssdGatewayResource\Pages;

use App\Filament\Resources\UssdGatewayResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use function App\Filament\Resources\checkDeleteUssdGatewayPermission;

class EditUssdGateway extends EditRecord
{
    protected static string $resource = UssdGatewayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->visible(function(){
                return checkDeleteUssdGatewayPermission();
            }),
        ];
    }
}
