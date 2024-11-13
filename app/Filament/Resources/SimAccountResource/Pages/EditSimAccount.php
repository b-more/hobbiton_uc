<?php

namespace App\Filament\Resources\SimAccountResource\Pages;

use App\Filament\Resources\SimAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use function App\Filament\Resources\checkDeleteSimAccountPermission;

class EditSimAccount extends EditRecord
{
    protected static string $resource = SimAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->visible(function(){
                return checkDeleteSimAccountPermission();
            }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
