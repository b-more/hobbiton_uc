<?php

namespace App\Http\Controllers;

use App\Models\SimAccount;
use App\Models\SmsOutbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OutboxController extends Controller
{
    function addLineNumbersAndNewlines($inputString) {
        // Split the input string into lines
        $lines = explode("\n", $inputString);
        
        // Initialize a variable to store the modified message
        $modifiedMessage = '';
    
        // Iterate through the lines and add line numbers
        foreach ($lines as $key => $line) {
            // Trim any leading/trailing whitespace from the line
            $line = trim($line);
    
            // Add the line number (if not empty)
            if (!empty($line)) {
                $modifiedMessage .= ($key + 1) . '. ' . $line . "\n";
            } else {
                $modifiedMessage .= "\n"; // Add a newline if the line is empty
            }
        }
    
        return $modifiedMessage;
    }

    function send_single_sms_uc($ip_address, $port_no, $phone_number, $message): void   
    {
        $changed_msg = $this->addLineNumbersAndNewlines($message);

        Log::info('changed message', ['chalila'=>$changed_msg]);

    $username = 'Ontech';
    $password = 'Admin.1234!!!!';
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
        CURLOPT_USERPWD => "Ontech:Admin.1234!!!",
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
        "text":"' . $changed_msg . '",
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

    public function response_from_akros(Request $request){
        $request->validate([
            'message_string'=>'required',
            'phone_number'=>'required'
        ]);

        //Send to UC2000 Gateway
        $sending_sim_card = SimAccount::where('id', 1)->first();
        $this->send_single_sms_uc($sending_sim_card->gateway_ip, $sending_sim_card->port,$request->phone_number,$request->message_string);
        
        //Save in the database
        $message_to_akros = SmsOutbox::create([
            'sender_number'=>$sending_sim_card->sim_card_number,
            'receipient'=>$request->phone_number,
            'message'=>$request->message_string,
            'status'=>1,
            'user_id'=>3
        ]);
        $message_to_akros->save();
        //custom response
        $custom_response = [
            'success'=>true
        ];
        return response()->json($custom_response,200);
    }

}