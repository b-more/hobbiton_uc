<?php

namespace App\Filament\Resources\SmsInboxResource\Pages;

use App\Filament\Resources\SmsInboxResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use App\Models\SimAccount;
use Carbon\Carbon;

class ViewSmsInbox extends ViewRecord
{
    protected static string $resource = SmsInboxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('mark_read')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => !$this->record->is_read)
                ->action(function () {
                    $this->record->update(['is_read' => true]);
                    $this->notify('success', 'Message marked as read');
                }),

            Action::make('mark_unread')
                ->icon('heroicon-o-envelope')
                ->color('warning')
                ->visible(fn () => $this->record->is_read)
                ->action(function () {
                    $this->record->update(['is_read' => false]);
                    $this->notify('success', 'Message marked as unread');
                }),

            Action::make('back')
                ->icon('heroicon-m-arrow-left')
                ->url($this->getResource()::getUrl('index')),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $simAccount = SimAccount::where('port', $data['port'])->first();

        // Format the data for display
        $data['formatted_date'] = Carbon::parse($data['created_at'])->format('M d, Y h:i A');
        $data['sim_number'] = $simAccount?->sim_card_number ?? 'N/A';
        $data['service_provider'] = $simAccount?->ServiceProvider?->name ?? 'Unknown';

        return $data;
    }
}
