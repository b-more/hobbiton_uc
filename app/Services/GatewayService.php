<?php

namespace App\Services;

class GatewayService
{
    public static function getGatewayIpForBusiness(int $businessId): ?string
    {
        return match ($businessId) {
            2 => "102.23.120.245", // Gamepawa
            4 => "102.23.123.43",  // Hobbiton
            // Add more businesses as needed
            default => null
        };
    }

    public static function getAllGateways(): array
    {
        return [
            2 => [
                'name' => 'Gamepawa',
                'ip' => "102.23.120.245"
            ],
            4 => [
                'name' => 'Hobbiton',
                'ip' => "102.23.123.43"
            ],
            // Add more as needed
        ];
    }
}