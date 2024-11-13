<?php

namespace App\Filament\Resources\SmsInboxResource\Pages;

use App\Filament\Resources\SmsInboxResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkReadSmsInboxPermission;

class ListSmsInboxes extends ListRecords
{
    protected static string $resource = SmsInboxResource::class;

    protected function getHeaderActions(): array
    {
        return [
           // Actions\CreateAction::make(),
        ];
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadSmsInboxPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "business_id" => $user->business_id,
            "module" => "Sms Inbox",
            "activity" => "Viewed List Sms Inbox Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }


}

function receive_sms(): void
{
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://102.23.120.245/api/query_incoming_sms?flag=all',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: ',
    'Cookie: devckie=ddd2-0917-7023-0098'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

}
