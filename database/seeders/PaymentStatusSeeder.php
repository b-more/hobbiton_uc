<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'Pending',
            ],
            [
                'name' => 'Processing',
            ],
            [
                'name' => 'Completed',
            ],
            [
                'name' => 'Failed',
            ],
            [
                'name' => 'Cancelled',
            ],
            [
                'name' => 'Refunded',
            ]
        ];

        foreach ($statuses as $status) {
            DB::table('payment_statuses')->updateOrInsert(
                ['name' => $status['name']],
                $status
            );
        }
    }
}
