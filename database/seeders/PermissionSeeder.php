<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            [
                "role_id" => 1,
                "module" => "Audit Trails",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Businesses",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Contacts",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Contact Groups",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Features",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Messagings",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Payments",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Payment Channels",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Payment Intents",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Payment Methods",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Payment Statuses",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Permissions",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Roles",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Scheduled Smses",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Service Providers",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Sim Accounts",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "SMS Inboxes",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "SMS Outboxes",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Users",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "USSD Gateways",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "USSD Gateway Sessions",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "USSD Sessions",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Sms Account Types",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 1,
                "module" => "Total Sms",
                "create" => 0,
                "read" => 1,
                "update" => 0,
                "delete" => 0
            ],
            //Role 2 - Account Owner
            [
                "role_id" => 2,
                "module" => "Audit Trails",
                "create" => 0,
                "read" => 1,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Businesses",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Contacts",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 2,
                "module" => "Contact Groups",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 2,
                "module" => "Features",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Messagings",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 2,
                "module" => "Payments",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Payment Channels",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Payment Intents",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Payment Methods",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Payment Statuses",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Permissions",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Roles",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Scheduled Smses",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 2,
                "module" => "Service Providers",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Sim Accounts",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "SMS Inboxes",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 2,
                "module" => "SMS Outboxes",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 2,
                "module" => "Users",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 2,
                "module" => "USSD Gateways",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "USSD Gateway Sessions",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "USSD Sessions",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Sms Account Types",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Total Sms",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ]
        ]);
    }
}
