<?php

namespace App\Filament\Widgets;

use App\Models\SmsOutbox;
use Filament\Widgets\ChartWidget;

class OutSmsChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected static string $color = 'success';

    protected function getData(): array
    {
        $data = SmsOutbox::whereBetween('created_at', [
            now()->startOfMonth(),
            now()->endOfMonth(),
        ])->get()
            ->groupBy(function ($sms) {
                return $sms->created_at->format('Y-m-d'); // Group SMS by date
            })
            ->map(function ($group) {
                return $group->count(); // Count SMS for each day
            });
    
        return [
            'datasets' => [
                [
                    'label' => 'Sent SMS',
                    'data' => $data->values(), // Count of SMS for each day
                ],
            ],
            'labels' => $data->keys(), // Dates
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
