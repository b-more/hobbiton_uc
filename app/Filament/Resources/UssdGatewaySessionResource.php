<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UssdGatewaySessionResource\Pages;
use App\Filament\Resources\UssdGatewaySessionResource\RelationManagers;
use App\Models\UssdGatewaySession;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UssdGatewaySessionResource extends Resource
{
    protected static ?string $model = UssdGatewaySession::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Ussd Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUssdGatewaySessions::route('/'),
            'create' => Pages\CreateUssdGatewaySession::route('/create'),
            'edit' => Pages\EditUssdGatewaySession::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return checkReadUssdGatewaySessionPermission();
    }
}
