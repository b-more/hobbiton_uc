<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@ontech.co.zm',
                'password' => Hash::make('Admin.1234!!!!'),
                'role_id' => 1,
                'business_id' => 1,
                'is_client' => 0
            ],
            [
                'name' => 'Hobbiton',
                'email' => 'hobbiton@ontech.co.zm',
                'password' => Hash::make('User.1234'),
                'role_id' => 2,
                'business_id' => 2,
                'is_client' => 1
            ]

        ]);
    }
}
