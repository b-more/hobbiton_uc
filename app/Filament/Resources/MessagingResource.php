<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessagingResource\Pages;
use App\Filament\Resources\MessagingResource\RelationManagers;
use App\Models\Payment;
use App\Models\SimAccount;
use App\Models\SmsOutbox;
use Carbon\Carbon;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class MessagingResource extends Resource
{
    protected static ?string $model = SmsOutbox::class;

    protected static ?string $navigationGroup = 'Messages';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public static function form(Form $form): Form
    {
        if (Payment::where('business_id', Auth::user()->business_id)->latest()->where('end_date', '>=', Carbon::now())->count() > 0) {
            return $form
                ->schema([
                    Section::make('Send SMS')
                        ->description('Provide the required information')
                        ->aside()
                        ->schema([
                            Select::make('sender_number')->label('Sender Number/ ID')->required()->options(SimAccount::where('business_id',Auth::user()->business_id)->pluck('sim_card_number','sim_card_number')->toArray()),
                            TextInput::make('receipient')->required(),
                            Textarea::make('message')->required(),

                        ])
                ]);
        } else {
            return $form
                ->schema([
                    Section::make('Send SMS')
                        ->description('Provide the required information')
                        ->aside()
                        ->schema([
                            TextArea::make('sender_number')->disabled()->default('Please Pay to continue enjoying the service'),


                        ])
                ]);
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date & Time')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('sender_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('receipient')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('message')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(function ($record) {
                        return $record->message;
                    }),
                Tables\Columns\IconColumn::make('status')
                    ->sortable()
                    ->boolean(),
            ])
            ->defaultSort('created_at', 'desc')
            ->modifyQueryUsing(function (Builder $query) {
                // If not admin (business_id 1), filter by business SIM accounts
                if (Auth::user()->business_id != 1) {
                    $simNumbers = SimAccount::where('business_id', Auth::user()->business_id)
                        ->pluck('sim_card_number');
                    
                    $query->whereIn('sender_number', $simNumbers);
                }
            });
    }

    // Add this method to filter based on business
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (Auth::user()->business_id != 1) {
            $simNumbers = SimAccount::where('business_id', Auth::user()->business_id)
                ->pluck('sim_card_number');
            
            $query->whereIn('sender_number', $simNumbers);
        }

        return $query;
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
            'index' => Pages\ListMessagings::route('/'),
            'create' => Pages\CreateMessaging::route('/create'),
            'edit' => Pages\EditMessaging::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return "Messaging";
    }

    public static function shouldRegisterNavigation(): bool
    {
        return checkReadMessagingPermission();
    }
}



function send_bulk_sms_uc(): void
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://192.168.8.2/api/send_sms',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
    "text":"#param#",
    "port":[1],
    "param":[
        {
            "number":"0975020473",
            "text_param":["Testing bulk for pastor1"],"user_id":1},
            {"number":"0779205949","text_param":["Testing bulk for pastor2"],"user_id":2}]
}',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: devckie=ddd2-0917-7023-0098'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}
