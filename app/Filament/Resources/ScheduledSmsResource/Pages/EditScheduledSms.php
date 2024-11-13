<?php

namespace App\Filament\Resources\ScheduledSmsResource\Pages;

use App\Filament\Resources\ScheduledSmsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use function App\Filament\Resources\checkDeleteScheduledSmsPermission;

class EditScheduledSms extends EditRecord
{
    protected static string $resource = ScheduledSmsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->visible(function (){
                return checkDeleteScheduledSmsPermission();
            }),
        ];
    }
}
