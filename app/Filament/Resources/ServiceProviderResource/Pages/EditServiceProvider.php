<?php

namespace App\Filament\Resources\ServiceProviderResource\Pages;

use App\Filament\Resources\ServiceProviderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use function App\Filament\Resources\checkDeleteServiceProviderPermission;

class EditServiceProvider extends EditRecord
{
    protected static string $resource = ServiceProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->visible(function (){
                return checkDeleteServiceProviderPermission();
            }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
