<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('service_providers')->insert([
            [
                'name' => 'Airtel',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'MTN',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Zamtel',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ontech Cloud Services',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
    }

}
