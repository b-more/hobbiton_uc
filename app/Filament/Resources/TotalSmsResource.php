<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TotalSmsResource\Pages;
use App\Filament\Resources\TotalSmsResource\RelationManagers;
use App\Models\Business;
use App\Models\SimAccount;
use App\Models\TotalSms;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TotalSmsResource extends Resource
{
    protected static ?string $model = TotalSms::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Fill Total Sms Credit')
                    ->description('account sms total credit')
                    ->aside()
                    ->schema([
                        Select::make('business_id')
                            ->native(false)
                            ->label('Business Name')
                            ->options(Business::all()->pluck('name','id')->toArray())
                            ->reactive()
                            ->required(),
                        Select::make('sim_account_id')
                            ->native(false)
                            ->label('Sending ID')
                            ->options(function (callable $get) {
                                $acc = SimAccount::find($get('business_id'));
                                if (!$acc) {
                                    return [];
                                }
                                return $acc->pluck('sim_card_number', 'id')->toArray();
                            })
                            ->reactive()
                            ->required(),
                        TextInput::make('total_sms')->numeric()->required()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('business.name'),
                Tables\Columns\TextColumn::make('sim_account.name'),
                Tables\Columns\TextColumn::make('total_sms'),
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
            'index' => Pages\ListTotalSms::route('/'),
            'create' => Pages\CreateTotalSms::route('/create'),
            'edit' => Pages\EditTotalSms::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        //return checkReadTotalSmsPermission();
        return false;
    }
}
