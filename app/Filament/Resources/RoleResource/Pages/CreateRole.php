<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use App\Models\AuditTrail;
use App\Models\Permission;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use function App\Filament\Resources\checkReadRolePermission;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadRolePermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Roles",
            "activity" => "Viewed Create Roles Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }

    protected function afterCreate()
    {
        $record = $this->record;
        Log::info("created record", ["record" => $record]);

        $modules = [
            [
                "name" => "Audit Trails",
            ],
            [
                "name" => "Businesses",
            ],
            [
                "name" => "Contacts",
            ],
            [
                "name" => "Contact Groups",
            ],
            [
                "name" => "Features",
            ],
            [
                "name" => "Payments",
            ],
            [
                "name" => "Payment Channels",
            ],
            [
                "name" => "Payment Intents",
            ],
            [
                "name" => "Payment Methods",
            ],
            [
                "name" => "Payment Statuses",
            ],
            [
                "name" => "Permissions",
            ],
            [
                "name" => "Roles",
            ],
            [
                "name" => "Scheduled Smses",
            ],
            [
                "name" => "Service Providers",
            ],
            [
                "name" => "Sim Accounts",
            ],
            [
                "name" => "SMS Inboxes",
            ],
            [
                "name" => "SMS Outboxes",
            ],
            [
                "name" => "Users",
            ],
            [
                "name" => "USSD Gateways",
            ],
            [
                "name" => "USSD Gateway Sessions",
            ],
            [
                "name" => "USSD Sessions",
            ],
        ];

        foreach ($modules as $module)
        {
            $new_permission = Permission::create([
                "role_id" => $record->id,
                "module" => $module["name"],
                "create" => 0,
                "read" => 1,
                "update" => 0,
                "delete" => 0
            ]);

            $new_permission->save();
        }

        $user = Auth::user();
        $record = $this->record;
        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "module" => "Roles",
            "activity" => "Saved record => ".$record,
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
