<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Business;
use App\Models\Permission;
use App\Models\Role;
use App\Models\ServiceProvider;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

//UssdSession Model
function checkCreateUssdSessionPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'USSD Sessions')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadUssdSessionPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'USSD Sessions')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdateUssdSessionPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'USSD Sessions')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeleteUssdSessionPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'USSD Sessions')->where('role_id', $user->role_id)->first()->delete == 1;
}

//USSD Gateway Sessions
function checkCreateUssdGatewaySessionPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'USSD Gateway Sessions')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadUssdGatewaySessionPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'USSD Gateway Sessions')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdateUssdGatewaySessionPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'USSD Gateway Sessions')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeleteUssdGatewaySessionPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'USSD Gateway Sessions')->where('role_id', $user->role_id)->first()->delete == 1;
}

//UssdGateway Model
function checkCreateUssdGatewayPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'USSD Gateways')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadUssdGatewayPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'USSD Gateways')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdateUssdGatewayPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'USSD Gateways')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeleteUssdGatewayPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'USSD Gateways')->where('role_id', $user->role_id)->first()->delete == 1;
}

//User Model
function checkCreateUserPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Users')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadUserPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'Users')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdateUserPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Users')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeleteUserPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Users')->where('role_id', $user->role_id)->first()->delete == 1;
}

//TotalSms Model
function checkCreateTotalSmsPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Total Sms')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadTotalSmsPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'Total Sms')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdateTotalSmsPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Total Sms')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeleteTotalSmsPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Total Sms')->where('role_id', $user->role_id)->first()->delete == 1;
}

//SmsOutbox Model
function checkCreateSmsOutboxPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Sms Outboxes')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadSmsOutboxPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'Sms Outboxes')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdateSmsOutboxPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Sms Outboxes')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeleteSmsOutboxPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Sms Outboxes')->where('role_id', $user->role_id)->first()->delete == 1;
}

//SmsInbox Model
function checkCreateSmsInboxPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Sms Inboxes')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadSmsInboxPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'Sms Inboxes')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdateSmsInboxPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Sms Inboxes')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeleteSmsInboxPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Sms Inboxes')->where('role_id', $user->role_id)->first()->delete == 1;
}

//SmsAccountType Model
function checkCreateSmsAccountTypePermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Sms Account Types')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadSmsAccountTypePermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'Sms Account Types')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdateSmsAccountTypePermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Sms Account Types')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeleteSmsAccountTypePermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Sms Account Types')->where('role_id', $user->role_id)->first()->delete == 1;
}

//SimAccount Model
function checkCreateSimAccountPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Sim Accounts')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadSimAccountPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'Sim Accounts')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdateSimAccountPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Sim Accounts')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeleteSimAccountPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Sim Accounts')->where('role_id', $user->role_id)->first()->delete == 1;
}

//ServiceProvider Model
function checkCreateServiceProviderPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Service Providers')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadServiceProviderPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'Service Providers')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdateServiceProviderPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Service Providers')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeleteServiceProviderPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Service Providers')->where('role_id', $user->role_id)->first()->delete == 1;
}

//ScheduledSms Model
function checkCreateScheduledSmsPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Scheduled Smses')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadScheduledSmsPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'Scheduled Smses')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdateScheduledSmsPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Scheduled Smses')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeleteScheduledSmsPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Scheduled Smses')->where('role_id', $user->role_id)->first()->delete == 1;
}

//Role Model
function checkCreateRolePermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Roles')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadRolePermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'Roles')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdateRolePermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Roles')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeleteRolePermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Roles')->where('role_id', $user->role_id)->first()->delete == 1;
}

//Permission Model
function checkCreatePermissionPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Permissions')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadPermissionPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'Permissions')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdatePermissionPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Permissions')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeletePermissionPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Permissions')->where('role_id', $user->role_id)->first()->delete == 1;
}

//Payment Model
function checkCreatePaymentPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Payments')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadPaymentPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'Payments')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdatePaymentPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Payments')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeletePaymentPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Payments')->where('role_id', $user->role_id)->first()->delete == 1;
}

//PaymentIntent Model
function checkCreatePaymentIntentPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Payment Intents')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadPaymentIntentPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'Payment Intents')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdatePaymentIntentPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Payment Intents')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeletePaymentIntentPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Payment Intents')->where('role_id', $user->role_id)->first()->delete == 1;
}

//Messaging Model
function checkCreateMessagingPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Messagings')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadMessagingPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'Messagings')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdateMessagingPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Messagings')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeleteMessagingPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Messagings')->where('role_id', $user->role_id)->first()->delete == 1;
}

//Contact Model
function checkCreateContactPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Contacts')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadContactPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'Contacts')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdateContactPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Contacts')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeleteContactPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Contacts')->where('role_id', $user->role_id)->first()->delete == 1;
}

//ContactGroup Model
function checkCreateContactGroupPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Contact Groups')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadContactGroupPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'Contact Groups')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdateContactGroupPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Contact Groups')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeleteContactGroupPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Contact Groups')->where('role_id', $user->role_id)->first()->delete == 1;
}

//Business Model
function checkCreateBusinessPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Businesses')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadBusinessPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'Businesses')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdateBusinessPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Businesses')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeleteBusinessPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Businesses')->where('role_id', $user->role_id)->first()->delete == 1;
}

//AuditTrail Model
function checkCreateAuditTrailPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Audit Trails')->where('role_id', $user->role_id)->first()->create == 1;
}
function checkReadAuditTrailPermission(): bool
{
    $user = Auth::user();

    return Permission::where('module', 'Audit Trails')->where('role_id', $user->role_id)->first()->read == 1;
}
function checkUpdateAuditTrailPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Audit Trails')->where('role_id', $user->role_id)->first()->update == 1;
}
function checkDeleteAuditTrailPermission(): bool
{
    $user = Auth::user();
    return Permission::where('module', 'Audit Trails')->where('role_id', $user->role_id)->first()->delete == 1;
}

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'User Management';

    public static function getEloquentQuery(): Builder
    {
        // Check if there's an authenticated user
        $user = Auth::user();

        $query = parent::getEloquentQuery();

        if ($user->is_client == 0) {
            // Customize the query as needed
            return $query;
        }elseif($user->is_client == 1)
        {
            return $query->where('business_id', $user->business_id);
        }

        // If it's not regulator_id 1 or no authenticated user, return an empty query
        return static::getModel()::query()->where("service_provider_id", 0);

    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('')
                                    ->schema([

                                        FileUpload::make('avatar')
                                            ->label('Profile Picture')
                                            ->directory('profile_pics')
                                            ->avatar()
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '5:4'
                                            ])
                                            ->columnSpan('full'),
                                    ]),
                            ])
                            ->columnSpan(['lg' => 1]),
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('')
                                    ->schema([
                                        Grid::make('2')
                                            ->schema([
                                                TextInput::make('name')
                                                    ->label('Full Name')
                                                    ->prefixIcon('heroicon-o-user')
                                                    ->required(),
                                                Select::make('business_id')
                                                    ->label('Business')
                                                    ->options(Business::all()->pluck('name','id')->toArray())
                                                    ->required(),
                                            ]),
                                        Grid::make(1)
                                            ->schema([
                                                TextInput::make('email')
                                                    ->unique(ignoreRecord: true)
                                                    ->email()
                                                    ->prefixIcon('heroicon-o-user')
                                                    ->required(),
                                            ]),
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('phone_number')
                                                    ->unique(ignoreRecord: true)
                                                    ->length(10)
                                                    ->prefixIcon('heroicon-o-phone')
                                                    ->required(),
                                                TextInput::make('password')
                                                    ->password()
                                                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                                                    ->dehydrated(fn (?string $state): bool => filled($state))
                                            ]),
                                        Grid::make('2')
                                            ->schema([
                                                Select::make('role_id')
                                                    ->label('User Role')
                                                    ->options(function(){
                                                        if(Auth::user()->is_client == 1)
                                                        {
                                                            return Role::where('name', 'not like', 'Ontech%')->pluck('name', 'id')->toArray();

                                                        }else{
                                                            return Role::all()->pluck("name","id")->toArray();
                                                        }
                                                    })
                                                    ->prefixIcon('heroicon-m-cog-8-tooth')
                                                    ->required(),
                                                Select::make('is_client')
                                                    ->label('Is Client?')
                                                    ->options([
                                                        1 => "Yes",
                                                        0 => "No"
                                                    ])
                                                    ->required(),

                                            ]),
                                        Grid::make('2')
                                            ->schema([
                                                Select::make('is_active')
                                                    ->label('Is Active?')
                                                    ->options([
                                                        1 => "Yes",
                                                        0 => "No"
                                                    ])
                                                    ->required(),
                                                Select::make('is_deleted')
                                                    ->label('Is Deleted?')
                                                    ->options([
                                                        1 => "Yes",
                                                        0 => "No"
                                                    ])
                                                    ->required(),
                                            ]),

                                    ]),

                            ])
                            ->columnSpan(['lg' => 2]),
                    ])
                    ->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->wrap(),
                Tables\Columns\TextColumn::make('role.name'),
                Tables\Columns\TextColumn::make('email')->wrap(),
                Tables\Columns\TextColumn::make('is_active')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return checkReadUserPermission();
    }
}
