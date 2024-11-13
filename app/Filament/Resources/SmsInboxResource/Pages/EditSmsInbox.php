<?php

namespace App\Filament\Resources\SmsInboxResource\Pages;

use App\Filament\Resources\SmsInboxResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use function App\Filament\Resources\checkDeleteSmsInboxPermission;

class EditSmsInbox extends EditRecord
{
    protected static string $resource = SmsInboxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->visible(function(){
                return checkDeleteSmsInboxPermission();
            }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
