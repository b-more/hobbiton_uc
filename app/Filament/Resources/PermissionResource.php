<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermissionResource\Pages;
use App\Filament\Resources\PermissionResource\RelationManagers;
use App\Models\Permission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'User Management';

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
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('role.name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('module')->sortable()->searchable(),
                Tables\Columns\ToggleColumn::make('create')->sortable()
                    ->onColor('success')
                    ->offColor('danger'),
                Tables\Columns\ToggleColumn::make('read')->sortable()
                    ->onColor('success')
                    ->offColor('danger'),
                Tables\Columns\ToggleColumn::make('update')->sortable()
                    ->onColor('success')
                    ->offColor('danger'),
                Tables\Columns\ToggleColumn::make('delete')->sortable()
                    ->onColor('success')
                    ->offColor('danger'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                   // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPermissions::route('/'),
            //'create' => Pages\CreatePermission::route('/create'),
            //'edit' => Pages\EditPermission::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return checkReadPermissionPermission();
    }
}
