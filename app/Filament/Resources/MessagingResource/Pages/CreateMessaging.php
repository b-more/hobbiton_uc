<?php

namespace App\Filament\Resources\MessagingResource\Pages;

use App\Filament\Resources\MessagingResource;
use App\Models\AuditTrail;
use App\Models\SimAccount;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification;

class CreateMessaging extends CreateRecord
{
    protected static string $resource = MessagingResource::class;

    public function mount(): void
    {
        parent::mount();

        $user = Auth::user();

        AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Messaging",
            "activity" => "Viewed Create Messaging Page",
            "ip_address" => request()->ip()
        ]);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        $data['status'] = 1;

        return $data;
    }

    protected function afterCreate(): void
    {
        try {
            $message = $this->record;

            $sim_account = SimAccount::where('sim_card_number', $message->sender_number)
                ->where('is_active', true)
                ->first();

            if (!$sim_account) {
                throw new \Exception('Invalid or inactive SIM account');
            }

            $this->send_single_sms_uc(
                $sim_account->gateway_ip,
                $sim_account->port,
                $message->receipient,
                $message->message
            );

            // Send webhook notification after successful SMS
            $this->send_webhook_notification($message);

        } catch (\Exception $e) {
            Log::error('Failed to send SMS', [
                'error' => $e->getMessage(),
                'message' => $message ?? null
            ]);

            if (isset($message)) {
                $message->update(['status' => 0]);
            }

            Notification::make()
                ->title('Failed to Send Message')
                ->danger()
                ->body($e->getMessage())
                ->send();
        }
    }

   


    protected function send_single_sms_uc($ip_address, $port_no, $phone_number, $message): void
{
    try {
        // Add line numbers to message (like in OutboxController)
        // $lines = explode("\n", $message);
        // $modifiedMessage = '';
        // foreach ($lines as $key => $line) {
        //     $line = trim($line);
        //     if (!empty($line)) {
        //         $modifiedMessage .= ($key + 1) . '. ' . $line . "\n";
        //     } else {
        //         $modifiedMessage .= "\n";
        //     }
        // }

        Log::info('Sending SMS', [
            'ip_address' => $ip_address,
            'port' => $port_no,
            'phone_number' => $phone_number,
            'message' => $message
        ]);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://' . $ip_address . '/api/send_sms',
            CURLOPT_HTTPAUTH => CURLAUTH_ANY,
            CURLOPT_HEADER => false, // Changed to false to get clean response
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_USERPWD => "Ontech:Admin.1234!!!!",
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                'text' => $message,
                'port' => [$port_no],
                'param' => [
                    ['number' => $phone_number]
                ]
            ]),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        Log::info('UC Gateway Response', [
            'response' => $response,
            'error' => $error,
            'http_code' => $httpCode
        ]);

        curl_close($curl);

        if ($response === false) {
            throw new \Exception("Gateway error: " . $error);
        }

        // Try to decode JSON response
        $responseData = @json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::warning('Invalid JSON response', [
                'response' => $response,
                'json_error' => json_last_error_msg()
            ]);
        }

        // Update the message record with the response
        if ($this->record && $responseData) {
            $this->record->update([
                'status' => true,
                'response_data' => $responseData
            ]);
        }

    } catch (\Exception $e) {
        Log::error('SMS sending failed', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        throw $e;
    }
}

// Modified webhook notification method
protected function send_webhook_notification($message): void
{
    try {
        $curl = curl_init();

        $postData = [
            'sn' => uniqid('sms_', true), // Generate a unique ID if none exists
            'sms' => [
                [
                    'incoming_sms_id' => $message->id,
                    'port' => $message->port ?? 0,
                    'number' => $message->receipient,
                    'smsc' => $message->sender_number,
                    'timestamp' => now()->format('Y-m-d H:i:s'),
                    'text' => $message->message
                ]
            ]
        ];

        Log::info('Webhook payload', ['data' => $postData]);

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://ucsms.crmzambia.com/api/webhook',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($postData),
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Content-Type: application/json',
            ],
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        Log::info('Webhook response', [
            'response' => $response,
            'error' => $error
        ]);

        curl_close($curl);

        if ($error) {
            throw new \Exception("Webhook notification failed: " . $error);
        }

    } catch (\Exception $e) {
        Log::error('Webhook notification failed', [
            'error' => $e->getMessage(),
            'message_id' => $message->id ?? null
        ]);
        // Don't throw the exception to prevent the main process from failing
    }
}

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Message sent successfully';
    }
}
