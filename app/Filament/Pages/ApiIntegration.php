<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ApiIntegration extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.api-integration';

    public function getTitle(): string
    {
        return "API Integration";
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
