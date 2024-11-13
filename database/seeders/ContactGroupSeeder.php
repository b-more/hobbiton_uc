<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contact_groups')->insert([
            [
                'user_id' => 1,
                'business_id' => 2,
                'name' => 'OntechGroup' 
            ],
            [
                'user_id' => 1,
                'business_id' => 1,
                'name' => 'OntechGroup' 
            ]
        ]);
    }
}
