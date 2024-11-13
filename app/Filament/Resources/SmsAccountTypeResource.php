<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SmsAccountTypeResource\Pages;
use App\Filament\Resources\SmsAccountTypeResource\RelationManagers;
use App\Models\SmsAccountType;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SmsAccountTypeResource extends Resource
{
    protected static ?string $model = SmsAccountType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Fill SMS Account')
                    ->description('provide the name of the account type')
                    ->aside()
                    ->schema([
                        TextInput::make('name')->unique(ignoreRecord: true)->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
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
            'index' => Pages\ListSmsAccountTypes::route('/'),
            'create' => Pages\CreateSmsAccountType::route('/create'),
            'edit' => Pages\EditSmsAccountType::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return checkReadSmsAccountTypePermission();
    }
}
