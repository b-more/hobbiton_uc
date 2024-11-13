<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessResource\Pages;
use App\Filament\Resources\BusinessResource\RelationManagers;
use App\Models\Business;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusinessResource extends Resource
{
    protected static ?string $model = Business::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Add Business')
                ->description('Provide the required information')
                ->aside()
                ->schema([
                    TextInput::make('name')->required()->label('Business Name'),
                    TextInput::make('email')->required()->label('Business Email'),
                    TextInput::make('secret_key')->required()->label('Password'),


                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable()->wrap()->label('Company name'),
                Tables\Columns\TextColumn::make('email')->searchable()->sortable()->wrap()->label('Business Email'),
                Tables\Columns\IconColumn::make('is_active')
                ->toggleable()
                ->boolean()
                ->label('Status'),
                Tables\Columns\TextColumn::make('created_at')->searchable()->sortable()->label('Date Created'),

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
            'index' => Pages\ListBusinesses::route('/'),
            'create' => Pages\CreateBusiness::route('/create'),
            'edit' => Pages\EditBusiness::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return checkReadBusinessPermission();
    }
}
