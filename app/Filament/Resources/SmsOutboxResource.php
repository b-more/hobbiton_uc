<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SmsOutboxResource\Pages;
use App\Filament\Resources\SmsOutboxResource\RelationManagers;
use App\Models\SimAccount;
use App\Models\SmsOutbox;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SmsOutboxResource extends Resource
{
    protected static ?string $model = SmsOutbox::class;

    protected static ?string $navigationIcon = 'heroicon-m-calendar-days';

    protected static ?string $navigationLabel = 'Schedule SMS';

    protected static ?string $navigationGroup = 'Messages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Send SMS')
                        ->description('Provide the required information')
                        ->aside()
                        ->schema([
                            Select::make('sender_number')->required()->options(SimAccount::where('business_id',Auth::user()->business_id)->pluck('sim_card_number','sim_card_number')->toArray()),
                            TextInput::make('receipient')->required(),
                            Textarea::make('message')->required(),
                            DatePicker::make('schedule_date')->required()->displayFormat('M d Y'),
                            TimePicker::make('schedule_time')->required()->withoutSeconds(),

                        ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('sender_number')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('receipient')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('message')->searchable()->sortable(),
                Tables\Columns\IconColumn::make('status')->sortable()->boolean(),
                Tables\Columns\IconColumn::make('schedule_date')->sortable(),
                Tables\Columns\IconColumn::make('schedule_time')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Date & Time Sent')->dateTime()
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
            'index' => Pages\ListSmsOutboxes::route('/'),
            'create' => Pages\CreateSmsOutbox::route('/create'),
            'edit' => Pages\EditSmsOutbox::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        //return checkReadSmsOutboxPermission();
        return false;
    }
    public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->whereHas('user', function ($query) {
            $query->where('business_id', Auth::user()->business_id);
        });
}
}
