<?php

namespace App\Filament\Resources\ScheduledSmsResource\Pages;

use App\Filament\Resources\ScheduledSmsResource;
use App\Models\AuditTrail;
use App\Models\SimAccount;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use function App\Filament\Resources\checkReadScheduledSmsPermission;

class CreateScheduledSms extends CreateRecord
{
    protected static string $resource = ScheduledSmsResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Message scheduled successfully';
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadScheduledSmsPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Scheduled Sms",
            "activity" => "Viewed Create Scheduled Sms Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user_id = Auth::user()->id;
        $data['user_id'] = $user_id;
        $data['status'] = 1;

        return $data;
    }

    protected function afterCreate()
    {
        $message = $this->record;
        $sim_account = SimAccount::where('sim_card_number', $message->sender_number)->first();


        Log::info('After create ', ['message' => $message]);

        Log::info('After create', ['sim_account' => $sim_account]);
        //send message
        send_single_sms_uc($sim_account->gateway_ip, $sim_account->port, $message->receipient, $message->message);
    }
}

function send_single_sms_uc($ip_address, $port_no, $phone_number, $message): void
{
    $username = 'ONTECH';
    $password = 'Admin.1234!!!';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://' . $ip_address . '/api/send_sms',
        CURLOPT_HTTPAUTH => CURLAUTH_ANY,
        CURLOPT_HEADER => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_USERPWD => "ONTECH:Admin.1234!!!",
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
        "text":"' . $message . '",
        "port":[' . $port_no . '],
        "param":[
            {"number":"' . $phone_number . '"}

        ]

        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
        ),

    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;

    Log::info('Response from UC', ['response' => $response]);

    if ($response === false) {
        Log::info('cURL Error: ' . curl_error($curl));
        Log::info('cURL Error Number: ' . curl_errno($curl));
    }

}
