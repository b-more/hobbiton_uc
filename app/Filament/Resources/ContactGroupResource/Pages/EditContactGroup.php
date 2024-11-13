<?php

namespace App\Filament\Resources\ContactGroupResource\Pages;

use App\Filament\Resources\ContactGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use function App\Filament\Resources\checkDeleteContactGroupPermission;

class EditContactGroup extends EditRecord
{
    protected static string $resource = ContactGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->visible(function (){
                return checkDeleteContactGroupPermission();
            }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
