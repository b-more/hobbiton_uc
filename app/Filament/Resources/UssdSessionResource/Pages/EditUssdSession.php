<?php

namespace App\Filament\Resources\UssdSessionResource\Pages;

use App\Filament\Resources\UssdSessionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use function App\Filament\Resources\checkDeleteUssdSessionPermission;

class EditUssdSession extends EditRecord
{
    protected static string $resource = UssdSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->visible(function(){
                return checkDeleteUssdSessionPermission();
            }),
        ];
    }
}
