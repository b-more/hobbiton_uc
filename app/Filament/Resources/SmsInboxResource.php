<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SmsInboxResource\Pages;
use App\Models\SmsInbox;
use App\Models\Payment;
use App\Models\SimAccount;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\Grid;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Illuminate\Database\Eloquent\Builder;

class SmsInboxResource extends Resource
{
    protected static ?string $model = SmsInbox::class;
    protected static ?string $navigationGroup = 'Messages';
    protected static ?string $navigationIcon = 'heroicon-s-inbox-arrow-down';

    // Add badge to show unread count
    public static function getNavigationBadge(): ?string
    {
        try {
            if (!Schema::hasColumn('sms_inboxes', 'is_read')) {
                return null;
            }

            return static::getModel()::where(function ($query) {
                // First check if the column exists to prevent errors
                if (Schema::hasColumn('sms_inboxes', 'is_read')) {
                    $query->where('is_read', false);
                }

                if (Auth::user()->business_id != 1) { // Not admin
                    $ports = SimAccount::where('business_id', Auth::user()->business_id)
                        ->pluck('port');
                    $query->whereIn('port', $ports);
                }
            })->count() ?: null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getNavigationBadge() ? 'warning' : null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Message Details')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('sender_number')
                                    ->label('From')
                                    ->disabled()
                                    ->columnSpan(1),

                                TextInput::make('formatted_date')
                                    ->label('Received At')
                                    ->disabled()
                                    ->columnSpan(1),

                                TextInput::make('sim_number')
                                    ->label('Receiver SIM')
                                    ->disabled()
                                    ->columnSpan(1),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('service_provider')
                                    ->label('Service Provider')
                                    ->disabled(),

                                TextInput::make('port')
                                    ->label('Port Number')
                                    ->disabled(),
                            ]),

                        Textarea::make('message')
                            ->label('Message Content')
                            ->disabled()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(3),

                Section::make('Message Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('serial_number')
                                    ->label('Serial Number')
                                    ->disabled(),

                                TextInput::make('incoming_sms_id')
                                    ->label('SMS ID')
                                    ->disabled(),
                            ]),

                        TextInput::make('smsc')
                            ->label('SMSC')
                            ->disabled(),
                    ])
                    ->collapsed()
                    ->collapsible(),
            ]);
    }

    // public static function table(Table $table): Table
    // {
    //     return $table
    //         ->columns([
    //             Tables\Columns\TextColumn::make('created_at')
    //                 ->label('Date & Time')
    //                 ->dateTime()
    //                 ->sortable()
    //                 ->searchable(),

    //             Tables\Columns\TextColumn::make('sender_number')
    //                 ->label('From')
    //                 ->searchable()
    //                 ->sortable(),

    //             Tables\Columns\TextColumn::make('message')
    //                 ->searchable()
    //                 ->limit(50)
    //                 ->wrap()
    //                 ->tooltip(function ($record) {
    //                     return $record->message;
    //                 }),

    //             Tables\Columns\TextColumn::make('port')
    //                 ->label('Port')
    //                 ->description(function($record) {
    //                     $simAccount = SimAccount::where('port', $record->port)
    //                         ->where('business_id', Auth::user()->business_id)
    //                         ->first();
    //                     return $simAccount ? "SIM: {$simAccount->sim_card_number}" : 'N/A';
    //                 }),

    //             Tables\Columns\TextColumn::make('gateway')
    //                 ->label('Gateway')
    //                 ->getStateUsing(function ($record) {
    //                     $simAccount = SimAccount::where('port', $record->port)
    //                         ->where('business_id', Auth::user()->business_id)
    //                         ->first();
    //                     return $simAccount ? "UC2000 ({$simAccount->gateway_ip})" : 'N/A';
    //                 }),
    //         ])
    //         ->defaultSort('created_at', 'desc')
    //         ->filters([
    //             Tables\Filters\SelectFilter::make('gateway_ip')
    //                 ->label('Gateway')
    //                 ->options(function () {
    //                     return SimAccount::where('business_id', Auth::user()->business_id)
    //                         ->where('is_active', true)
    //                         ->pluck('gateway_ip', 'gateway_ip')
    //                         ->map(function ($ip) {
    //                             return "UC2000 ({$ip})";
    //                         })
    //                         ->toArray();
    //                 }),

    //             Tables\Filters\SelectFilter::make('port')
    //                 ->label('Port')
    //                 ->options(function () {
    //                     return SimAccount::where('business_id', Auth::user()->business_id)
    //                         ->where('is_active', true)
    //                         ->pluck('sim_card_number', 'port')
    //                         ->toArray();
    //                 }),
    //         ])
    //         ->actions([
    //             Tables\Actions\ViewAction::make(),
    //         ]);
    // }

    // public static function getEloquentQuery(): Builder
    // {
    //     $query = parent::getEloquentQuery();

    //     if (Auth::user()->business_id !== 1) {
    //         $simAccounts = SimAccount::where('business_id', Auth::user()->business_id)
    //             ->where('is_active', true)
    //             ->get();

    //         $gatewayPorts = $simAccounts->groupBy('gateway_ip')
    //             ->map(function ($sims) {
    //                 return $sims->pluck('port')->toArray();
    //             });

    //         $query->where(function ($q) use ($gatewayPorts) {
    //             foreach ($gatewayPorts as $gatewayIp => $ports) {
    //                 $q->orWhere(function ($subQ) use ($gatewayIp, $ports) {
    //                     $subQ->whereIn('port', $ports);
    //                 });
    //             }
    //         });
    //     }

    //     return $query;
    // }

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
                    ->label('From')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('message')
                    ->searchable()
                    ->limit(50)
                    ->wrap()
                    ->tooltip(function ($record) {
                        return $record->message;
                    }),
                Tables\Columns\TextColumn::make('port')
                    ->label('Port')
                    ->description(function($record) {
                        $simAccount = SimAccount::where('port', $record->port)
                            ->where('business_id', Auth::user()->business_id)
                            ->first();
                        return $simAccount ? "SIM: {$simAccount->sim_card_number}" : 'N/A';
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->modifyQueryUsing(function (Builder $query) {
                // Get the gateway IP for the logged-in user's business
                $gatewayIp = match (Auth::user()->business_id) {
                    2 => "102.23.120.245", // Gamepawa
                    4 => "102.23.123.43",  // Hobbiton
                    // Add more cases as needed
                    default => null
                };

                Log::info('Filtering inbox by business and IP', [
                    'business_id' => Auth::user()->business_id,
                    'gateway_ip' => $gatewayIp
                ]);

                if ($gatewayIp) {
                    $query->where('gateway_ip', $gatewayIp);
                }

                if (Auth::user()->business_id !== 1) {
                    $query->where('business_id', Auth::user()->business_id);
                }
            })
            ->filters([
                SelectFilter::make('port')
                    ->label('SIM Port')
                    ->options(function () {
                        return SimAccount::query()
                            ->where('business_id', Auth::user()->business_id)
                            ->where('is_active', true)
                            ->get()
                            ->mapWithKeys(function ($sim) {
                                return [$sim->port => "Port {$sim->port} (SIM: {$sim->sim_card_number})"];
                            })
                            ->toArray();
                    }),
                    
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from'),
                        Forms\Components\DatePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                //Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Get the gateway IP for the logged-in user's business
        $gatewayIp = match (Auth::user()->business_id) {
            2 => "102.23.120.245", // Gamepawa
            4 => "102.23.123.43",  // Hobbiton
            // Add more cases as needed
            default => null
        };

        if ($gatewayIp) {
            $query->where('gateway_ip', $gatewayIp);
        }

        if (Auth::user()->business_id !== 1) {
            $query->where('business_id', Auth::user()->business_id);
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
            'index' => Pages\ListSmsInboxes::route('/'),
           // 'view' => Pages\ViewSmsInbox::route('/{record}'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return checkReadSmsInboxPermission();
    }
}
