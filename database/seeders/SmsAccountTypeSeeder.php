<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SmsAccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sms_account_types')->insert([
            [
                'name' => 'Physical SIM Card'
            ],
            [
                'name' => 'Alphanumeric ID'
            ],
            [
                'name' => 'Digital Short Code'
            ]

        ]);
    }
}
