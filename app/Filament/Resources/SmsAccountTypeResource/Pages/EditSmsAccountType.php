<?php

namespace App\Filament\Resources\SmsAccountTypeResource\Pages;

use App\Filament\Resources\SmsAccountTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use function App\Filament\Resources\checkDeleteSmsAccountTypePermission;

class EditSmsAccountType extends EditRecord
{
    protected static string $resource = SmsAccountTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->visible(function(){
                return checkDeleteSmsAccountTypePermission();
            }),
        ];
    }
}
