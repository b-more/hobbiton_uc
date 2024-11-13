<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts')->insert([
           [
            'name' => 'Isaac Malemelo',
            'phone_number' => '0779205949',
            'contact_group_id' => 1,
            'user_id' => 1,
           ],
           [
            'name' => 'Blessmore Mulenga',
            'phone_number' => '0975020473',
            'contact_group_id' => 1,
            'user_id' => 1,
           ],
           [
            'name' => 'Dennis Zitha',
            'phone_number' => '0979669350',
            'contact_group_id' => 1,
            'user_id' => 1,
           ],
           [
            'name' => 'Wezi Munthali',
            'phone_number' => '0972718518',
            'contact_group_id' => 1,
            'user_id' => 1,
           ],
        ]);
    }
}
