<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SimAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sim_accounts')->insert([
            [
                'service_provider_id' => 2,
                'business_id' => 2,
                'sms_account_type_id' => 1,
                'sim_card_number' => '0761658936',
                'port' => 0,
                'gateway_ip' => '102.23.123.56',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'service_provider_id' => 1,
                'business_id' => 2,
                'sms_account_type_id' => 1,
                'sim_card_number' => '0974300591',
                'port' => 1,
                'gateway_ip' => '102.23.123.56',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'service_provider_id' => 1,
                'business_id' => 2,
                'sms_account_type_id' => 1,
                'sim_card_number' => '0777410310',
                'port' => 2,
                'gateway_ip' => '102.23.123.56',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'service_provider_id' => 3,
                'business_id' => 2,
                'sms_account_type_id' => 1,
                'sim_card_number' => '0956037074',
                'port' => 3,
                'gateway_ip' => '102.23.123.56',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
