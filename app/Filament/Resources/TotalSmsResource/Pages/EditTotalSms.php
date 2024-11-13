<?php

namespace App\Filament\Resources\TotalSmsResource\Pages;

use App\Filament\Resources\TotalSmsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use function App\Filament\Resources\checkDeleteTotalSmsPermission;

class EditTotalSms extends EditRecord
{
    protected static string $resource = TotalSmsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->visible(function(){
                return checkDeleteTotalSmsPermission();
            }),
        ];
    }


}
