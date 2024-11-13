<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SimAccountResource\Pages;
use App\Filament\Resources\SimAccountResource\RelationManagers;
use App\Models\SimAccount;
use App\Models\Business;
use App\Models\ServiceProvider;
use App\Models\SmsAccountType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SimAccountResource extends Resource
{
    protected static ?string $model = SimAccount::class;

    protected static ?string $navigationIcon = 'heroicon-m-wallet';

    protected static ?string $navigationGroup = 'User Management';

    protected static ?string $navigationLabel = "SMS Accounts";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Configurations')
                ->description('Provide the required information')
                ->aside()
                ->schema([
                    Select::make('business_id')->required()->options(Business::all()->pluck('name','id')->toArray()),
                    Select::make('sms_account_type_id')
                        ->options(SmsAccountType::all()->pluck('name','id')->toArray())
                        ->required()
                        ->live()
                        ->afterStateUpdated(fn(Select $component) => $component
                            ->getContainer()
                            ->getComponent('account_type_id')
                            ->getChildComponentContainer()
                            ->fill()),
                    Forms\Components\Grid::make(1)
                            ->schema(fn(Get $get): array => match ($get('sms_account_type_id')){
                                '1' => [
                                    Select::make('service_provider_id')->required()->options(ServiceProvider::all()->pluck('name','id')->toArray()),
                                    TextInput::make('sim_card_number')->required(),
                                    TextInput::make('port')->required(),
                                    TextInput::make('gateway_ip')->required()
                                ],
                                '2'  => [
                                    TextInput::make('alphanumeric_id')->maxLength('11')->required(),
                                ],
                                '3' => [
                                    TextInput::make('digital_short_code')->maxLength('11')->required(),
                                ],
                                default => [],
                            })
                            ->key('account_type_id'),


                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('Business.name')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('sms_account_type.name')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('alphanumeric_id')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('ServiceProvider.name')->label('Network')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('sim_card_number')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('port')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('gateway_ip')->searchable()->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                ->toggleable()
                ->boolean(),
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
            'index' => Pages\ListSimAccounts::route('/'),
            'create' => Pages\CreateSimAccount::route('/create'),
            'edit' => Pages\EditSimAccount::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return checkReadSimAccountPermission();
    }
}
