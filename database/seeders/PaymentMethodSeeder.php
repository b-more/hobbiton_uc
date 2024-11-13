<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [
            [
                'name' => 'Bank Transfer',
            ],
            [
                'name' => 'Airtel Mobile Money',
            ],
            [
                'name' => 'Mtn Mobile Money',
            ],
            [
                'name' => 'Zamtel Mobile Money',
            ],
            [
                'name' => 'Zed Mobile Money',
            ],
            [
                'name' => 'Credit Card',
            ],
            [
                'name' => 'Cash',
            ]
        ];

        foreach ($methods as $method) {
            DB::table('payment_methods')->updateOrInsert(
                ['name' => $method['name']],
                $method
            );
        }
    }
}
