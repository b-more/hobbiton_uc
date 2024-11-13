<?php

namespace App\Filament\Resources\MessagingResource\Pages;

use App\Filament\Resources\MessagingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use function App\Filament\Resources\checkDeleteMessagingPermission;

class EditMessaging extends EditRecord
{
    protected static string $resource = MessagingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->visible(function (){
                return checkDeleteMessagingPermission();
            }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
