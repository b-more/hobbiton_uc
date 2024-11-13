<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use App\Models\Business;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-m-banknotes';

    protected static ?string $navigationGroup = 'Payments Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Payments')
                ->description('Provide the required information')
                ->aside()
                ->schema([
                    Select::make('business_id')->required()->options(Business::all()->pluck('name','id')->toArray()),
                    DatePicker::make('start_date')->required()->label('Subscription Start Date'),
                    DatePicker::make('end_date')->required()->label('Subscription End Date'),
                    TextInput::make('amount')->required(),
                    Select::make('payment_method')->required()->options(['Cash'=>'Cash','Mobile Money'=>'Mobile Money','Bank'=>'Bank','Visa'=>'Visa']),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('business.name')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('start_date')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('end_date')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('amount')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('payment_method')->searchable()->sortable()->label('Method'),
                Tables\Columns\TextColumn::make('user.name')->searchable()->sortable()->label('Received By')->wrap(),
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return checkReadPaymentPermission();
    }
}
