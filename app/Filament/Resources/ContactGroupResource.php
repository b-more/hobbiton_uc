<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactGroupResource\Pages;
use App\Filament\Resources\ContactGroupResource\RelationManagers;
use App\Models\Business;
use App\Models\ContactGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\Section;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ContactGroupResource extends Resource
{
    protected static ?string $model = ContactGroup::class;


    protected static ?string $navigationGroup = 'Contacts';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Contact Group')
                ->description('Provide the name of the Contact Group')
                ->aside()
                ->schema([
                    TextInput::make('name')->required(),
                   ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('user.name')->searchable()->sortable()->label('Created By'),
                Tables\Columns\TextColumn::make('created_at')->label('Date & Time created')->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListContactGroups::route('/'),
            'create' => Pages\CreateContactGroup::route('/create'),
            'edit' => Pages\EditContactGroup::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return checkReadContactGroupPermission();
    }
}
