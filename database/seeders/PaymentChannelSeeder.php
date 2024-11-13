<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentChannelSeeder extends Seeder
{
    public function run(): void
    {
        $channels = [
            [
                'name' => 'USSD',
            ],
            [
                'name' => 'Mobile App',
            ],
            [
                'name' => 'Web App',
            ],
            [
                'name' => 'IVR',
            ],
            [
                'name' => 'Walk-in',
            ],
            [
                'name' => 'Visa',
            ],
            [
                'name' => 'Mastercard',
            ]
        ];

        foreach ($channels as $channel) {
            DB::table('payment_channels')->updateOrInsert(
                ['name' => $channel['name']],
                $channel
            );
        }
    }
}
