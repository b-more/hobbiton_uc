<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserSeeder::class);
        $this->call(BusinessSeeder::class);
        $this->call(ServiceProviderSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(SimAccountSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(PaymentChannelSeeder::class);
        $this->call(SmsAccountTypeSeeder::class);
        $this->call(PaymentStatusSeeder::class);
    }
}
