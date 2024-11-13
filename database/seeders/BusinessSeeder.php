<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('businesses')->insert([
            [
                'name' => 'Ontech Innovations',
                'email' => 'admin@ontech.co.zm',
                'secret_key' => Hash::make('uc_sms_system'),
                'is_active' => 1,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Hobbiton',
                'email' => 'hobbiton@ontech.co.zm',
                'secret_key' => Hash::make('hobbiton_uc_sms_system'),
                'is_active' => 1,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
