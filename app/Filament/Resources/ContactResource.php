<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use App\Models\ContactGroup;
use Filament\Forms;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkAction;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;


class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationGroup = 'Contacts';

    protected static ?string $navigationLabel = 'Add Contact';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Contacts')
                        ->description('Provide the required contact information')
                        ->aside()
                        ->schema([
                            Select::make('contact_group_id')->required()->options(ContactGroup::all()->pluck('name','id')->toArray()),
                            TextInput::make('name')->required(),
                            TextInput::make('phone_number')->tel()->required(),
                        ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('phone_number')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('ContactGroup.name')->searchable()->sortable()->label('Created By'),
                Tables\Columns\TextColumn::make('user.name')->searchable()->sortable()->label('Created By'),
                Tables\Columns\TextColumn::make('created_at')->label('Date & Time created')->dateTime()
            ])
            ->filters([
                SelectFilter::make('contact_id')
                ->label('Contact')
                ->multiple()
                ->options(Contact::all()->pluck('name','id')->toArray()),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()->label('Export Excel'),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return checkReadContactPermission();
    }
}
