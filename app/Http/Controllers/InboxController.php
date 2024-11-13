<?php

namespace App\Http\Controllers;

use App\Models\SimAccount;
use App\Models\SmsInbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class InboxController extends Controller
{
    public function webhook(Request $request)
    {
        try {
            // Log the raw incoming request
            Log::info('UC2000 Webhook (Gamepawa) - Raw Request', [
                'payload' => $request->all()
            ]);

            // Parse the JSON data
            $data = $request->json()->all();

            if (!isset($data['sn'])) {
                throw new Exception('Missing serial number');
            }

            $smsData = $this->extractSmsData($data);
            if (!$smsData) {
                throw new Exception('Invalid message format');
            }

            Log::info('UC2000 Webhook - Processed Message Data', [
                'sms_data' => $smsData
            ]);

            // Save to database
            $sms = new SmsInbox();
            $sms->serial_number = $data['sn'];
            $sms->incoming_sms_id = $smsData['incoming_sms_id'];
            $sms->port = is_null($smsData['port']) ? null : (int)$smsData['port']; // Handle port 0
            $sms->sender_number = $smsData['number'];
            $sms->smsc = $smsData['smsc'];
            $sms->message = $smsData['text'];
            $sms->business_id = 2;
            $sms->gateway_ip = "102.23.120.245";

            $sms->save();

            Log::info('Gamepawa UC2000 Webhook - SMS saved successfully', [
                'sms_id' => $sms->id
            ]);

            // Process business logic
            if (isset($smsData['port'])) {
                $simAccount = SimAccount::where('port', $smsData['port'])->first();
                
                if ($simAccount) {
                    Log::info('Gamepawa UC2000 Webhook - Found business', [
                        'business_id' => $simAccount->business_id,
                        'port' => $smsData['port']
                    ]);

                    if ($simAccount->business_id == 3) {
                        $this->sendMessage($smsData['text'], $smsData['number']);
                    }
                } else {
                    Log::warning('Gamepawa UC2000 Webhook - No SimAccount found for port', [
                        'port' => $smsData['port']
                    ]);
                }
            }

            return response()->json([
                'message' => 'SMS saved successfully',
                'sms_id' => $sms->id
            ]);

        } catch (Exception $e) {
            Log::error('UC2000 Webhook - Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'payload' => $request->all()
            ]);

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function webhookHobbiton(Request $request)
    {
        try {
            // Log the raw incoming request
            Log::info('UC2000 Webhook (Hobbiton) - Raw Request', [
                'payload' => $request->all()
            ]);

            // Parse the JSON data
            $data = $request->json()->all();

            if (!isset($data['sn'])) {
                throw new Exception('Missing serial number');
            }

            $smsData = $this->extractSmsData($data);
            if (!$smsData) {
                throw new Exception('Invalid message format');
            }

            Log::info('Hobbiton UC2000 Webhook - Processed Message Data', [
                'sms_data' => $smsData
            ]);

            // Save to database
            $sms = new SmsInbox();
            $sms->serial_number = $data['sn'];
            $sms->incoming_sms_id = $smsData['incoming_sms_id'];
            $sms->port = is_null($smsData['port']) ? null : (int)$smsData['port']; // Handle port 0
            $sms->sender_number = $smsData['number'];
            $sms->smsc = $smsData['smsc'];
            $sms->message = $smsData['text'];
            $sms->business_id = 4;
            $sms->gateway_ip = "102.23.123.43";

            $sms->save();

            Log::info('Hobbiton Webhook - SMS saved successfully', [
                'sms_id' => $sms->id
            ]);

            // Process business logic
            if (isset($smsData['port'])) {
                $simAccount = SimAccount::where('port', $smsData['port'])->first();
                
                if ($simAccount) {
                    Log::info('UC2000 Webhook - Found business', [
                        'business_id' => $simAccount->business_id,
                        'port' => $smsData['port']
                    ]);

                    if ($simAccount->business_id == 3) {
                        $this->sendMessage($smsData['text'], $smsData['number']);
                    }
                } else {
                    Log::warning('UC2000 Webhook - No SimAccount found for port', [
                        'port' => $smsData['port']
                    ]);
                }
            }

            return response()->json([
                'message' => 'SMS saved successfully',
                'sms_id' => $sms->id
            ]);

        } catch (Exception $e) {
            Log::error('UC2000 Webhook - Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'payload' => $request->all()
            ]);

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function extractSmsData(array $data): ?array
    {
        if (isset($data['sms']) && !empty($data['sms'])) {
            $sms = $data['sms'][0];
            return [
                'incoming_sms_id' => $sms['incoming_sms_id'] ?? null,
                'port' => $sms['port'] ?? null,
                'number' => $sms['number'] ?? '',
                'smsc' => $sms['smsc'] ?? '',
                'text' => $sms['text'] ?? '',
                'imsi' => $sms['imsi'] ?? null,
                'timestamp' => $sms['timestamp'] ?? null
            ];
        }

        if (isset($data['sms_deliver_status']) && !empty($data['sms_deliver_status'])) {
            $status = $data['sms_deliver_status'][0];
            return [
                'incoming_sms_id' => $status['ref_id'] ?? null,
                'port' => $status['port'] ?? null,
                'number' => $status['number'] ?? '',
                'smsc' => $status['imsi'] ?? '',
                'text' => $status['status_code'] ?? '',
            ];
        }

        return null;
    }

    private function sendMessage(string $message, string $phoneNumber): void
    {
        try {
            $response = Http::post('https://akros.researchzambia.tech/api/sms/uc', [
                'phone' => $phoneNumber,
                'text' => $message
            ]);

            Log::info('Akros API Response', [
                'response' => $response->json(),
                'status' => $response->status()
            ]);
        } catch (Exception $e) {
            Log::error('Akros API Error', [
                'error' => $e->getMessage(),
                'phone' => $phoneNumber
            ]);
        }
    }
}


// namespace App\Http\Controllers\Api;

// use App\Models\SimAccount;
// use App\Models\SmsInbox;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Log;

// class InboxController extends Controller
// {
//     public function webhookHobbiton(Request $request)
//     {
//         Log::info('UC2000 Hobbiton Webhook', ['incoming' => $request->all()]);
//         return $this->processWebhook($request, '102.23.123.56', 4); // Hobbiton business_id
//     }

//     public function webhookGamepawa(Request $request)
//     {
//         Log::info('UC2000 Gamepawa Webhook', ['incoming' => $request->all()]);
//         return $this->processWebhook($request, '102.23.120.245', 2); // Gamepawa business_id
//     }

//     public function webhookAkros(Request $request)
//     {
//         Log::info('UC2000 Akros Webhook', ['incoming' => $request->all()]);
//         return $this->processWebhook($request, '102.23.123.57', 3); // Akros business_id
//     }

//     protected function processWebhook(Request $request, string $gatewayIp, int $businessId)
//     {
//         try {
//             $data = $request->json()->all();

//             // Validate the data
//             if (!isset($data['sn'])) {
//                 throw new \Exception('Missing serial number');
//             }

//             // Extract SMS data
//             $smsData = null;
//             if (isset($data['sms'])) {
//                 $smsData = $data['sms'][0];
//                 $messageType = 'sms';
//             } elseif (isset($data['sms_deliver_status'])) {
//                 $smsData = $data['sms_deliver_status'][0];
//                 $messageType = 'status';
//             } else {
//                 throw new \Exception('Invalid message format');
//             }

//             // Verify this port belongs to this business
//             $simAccount = SimAccount::where('port', $smsData['port'])
//                 ->where('business_id', $businessId)
//                 ->where('gateway_ip', $gatewayIp)
//                 ->first();

//             if (!$simAccount) {
//                 Log::warning('Unauthorized port access attempt', [
//                     'port' => $smsData['port'],
//                     'business_id' => $businessId,
//                     'gateway_ip' => $gatewayIp
//                 ]);
//                 return response()->json(['error' => 'Unauthorized port'], 403);
//             }

//             // Save to database with business context
//             $sms = new SmsInbox();
//             $sms->serial_number = $data['sn'];
//             $sms->incoming_sms_id = $messageType === 'sms' ? $smsData['incoming_sms_id'] : $smsData['ref_id'];
//             $sms->port = $smsData['port'];
//             $sms->sender_number = $smsData['number'];
//             $sms->smsc = $smsData['smsc'] ?? $smsData['imsi'] ?? null;
//             $sms->message = $messageType === 'sms' ? $smsData['text'] : ($smsData['status_code'] ?? '');
//             $sms->gateway_ip = $gatewayIp;        // Add gateway IP
//             $sms->business_id = $businessId;      // Add business ID
//             $sms->save();

//             Log::info("UC2000 Message Processed", [
//                 'message_id' => $sms->id,
//                 'business' => $businessId,
//                 'gateway' => $gatewayIp
//             ]);

//             // Handle Akros-specific logic
//             if ($businessId === 3 && $messageType === 'sms') {
//                 $this->sendToAkros($smsData['text'], $smsData['number']);
//             }

//             return response()->json([
//                 'message' => 'SMS processed successfully',
//                 'sms_id' => $sms->id
//             ]);

//         } catch (\Exception $e) {
//             Log::error('UC2000 Webhook Error', [
//                 'error' => $e->getMessage(),
//                 'gateway_ip' => $gatewayIp,
//                 'business_id' => $businessId,
//                 'trace' => $e->getTraceAsString()
//             ]);

//             return response()->json([
//                 'error' => $e->getMessage()
//             ], 500);
//         }
//     }

//     protected function sendToAkros($message, $phoneNumber)
//     {
//         try {
//             $response = Http::post('https://akros.researchzambia.tech/api/sms/uc', [
//                 'phone' => $phoneNumber,
//                 'text' => $message
//             ]);

//             Log::info('Akros API Response', [
//                 'response' => $response->json(),
//                 'status' => $response->status()
//             ]);

//         } catch (\Exception $e) {
//             Log::error('Akros API Error', [
//                 'error' => $e->getMessage(),
//                 'phone' => $phoneNumber
//             ]);
//         }
//     }
// }