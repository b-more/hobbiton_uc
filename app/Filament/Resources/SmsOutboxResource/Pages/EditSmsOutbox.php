<?php

namespace App\Filament\Resources\SmsOutboxResource\Pages;

use App\Filament\Resources\SmsOutboxResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use function App\Filament\Resources\checkDeleteSmsOutboxPermission;

class EditSmsOutbox extends EditRecord
{
    protected static string $resource = SmsOutboxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->visible(function(){
                return checkDeleteSmsOutboxPermission();
            }),
        ];
    }
}
