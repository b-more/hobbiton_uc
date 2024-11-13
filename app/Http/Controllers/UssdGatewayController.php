<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\UssdGateway;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UssdGatewayController extends Controller
{
    public function mtn(Request $request)
    {
        Log::info('from MTN',["request" => $request]);

        $session_id = 0;
        $request_type = "1";
        $phone = "";
        $msg = "";

        if (isset($_GET['sessionID'])) {
            $session_id = $_GET['sessionID'];
        } else if (isset($_GET['sessionid'])) {
            $session_id = $_GET['sessionid'];
        } else if (isset($_GET['SESSIONID'])) {
            $session_id = $_GET['SESSIONID'];
        }

        if (isset($_GET['msisdn'])) {
            $phone = $_GET['msisdn'];
        } else if (isset($_GET['MSISDN'])) {
            $phone = $_GET['MSISDN'];
        } else if (isset($_GET['msisdn'])) {
            $phone = $_GET['msisdn'];
        }

        if (isset($_GET['INPUT'])) {
            $msg = $_GET['INPUT'];
        } else if (isset($_GET['input'])) {
            $msg = $_GET['input'];
        }

        $jsonData = array("REQUEST_TYPE" => $request_type,
            "SESSION_ID" => $session_id,
            "MESSAGE" => $msg,
            "MSISDN" => $phone);

        Log::info('from MTN',["request" => $jsonData]);



        $jsonDataEncoded = json_encode($jsonData);

        $url = "http://196.13.104.121:8001/v1/ussd";
        //$url = "http://172.16.200.10:8001/v1/ussd";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $result = curl_exec($ch);
        $result = json_decode($result);

        $ussd_body = "Coming Soon";
        $request_type = "3";

        if (!empty($result)) {
            $ussd_body = $result->ussd_response->USSD_BODY;
            $request_type = $result->ussd_response->REQUEST_TYPE;
        }

        $message_to_mtn = $ussd_body;

        if ($request_type == "1") { //initiate
            $request_type = "2";
        } else if ($request_type == "2") { //continue
            $request_type = "FC";
        } else if ($request_type == "3") { //Close session
            $request_type = "FB";
        }

        $headers = [
            "charge:N",
            "Content-Length: 100",
            "Content-Type: UTF-8",
            "Cache-Control: max-age=0",
            "Pragma: no-cache",
            "Expires: -1",
            "amount: 0",
            "cpRefId: " . time(),
            "Freeflow: " . $request_type,
        ];

        $response = response($message_to_mtn);

        foreach ($headers as $header) {
            $headerParts = explode(':', $header, 2);
            if (count($headerParts) === 2) {
                $response->header(trim($headerParts[0]), trim($headerParts[1]));
            }
        }

        return $response;

    }

    public function airtel(Request $request)
    {
        Log::info('from Airtel Direct',["request" => $request]);

        $session_id = 0;
        $request_type = "1";
        $phone = "";
        $msg = "";

        if (isset($_GET['SESSION_ID'])) {
            $session_id = $_GET['SESSION_ID'];
        } else if (isset($_GET['sessionid'])) {
            $session_id = $_GET['sessionid'];
        } else if (isset($_GET['TRANSACTION_ID'])) {
            $session_id = $_GET['TRANSACTION_ID'];
        } else if (isset($_GET['Sessionid'])){
            $session_id = $_GET['Sessionid'];
        }

        if (isset($_GET['msisdn'])) {
            $phone = $_GET['msisdn'];
        } else if (isset($_GET['MSISDN'])) {
            $phone = $_GET['MSISDN'];
        } else if (isset($_GET['msisdn'])) {
            $phone = $_GET['msisdn'];
        }

        if (isset($_GET['SUBSCRIBER_INPUT'])) {
            $msg = $_GET['SUBSCRIBER_INPUT'];
        } else if (isset($_GET['input'])) {
            $msg = $_GET['input'];
        } else if(isset($_GET['SUBSCRIBER_STRING'])) {
            $msg = $_GET['SUBSCRIBER_STRING'];
        } else if(isset($_GET['Subscriberinput']))
        {
            $msg = $_GET['Subscriberinput'];
        }


        $jsonData = array("REQUEST_TYPE" => $request_type,
            "SESSION_ID" => $session_id,
            "MESSAGE" => $msg,
            "MSISDN" => $phone);

        Log::info('AIRTEL request to Remote',["request" => $jsonData]);

        if($_GET['IS_NEW_REQUEST'] == 1)
        {
            //handle new session
            //extract the main_short_code, short_code and digits from string

            // Split the string based on '*'
            list($before_star, $after_star) = explode('*', $msg);

            // Characters before '*'
            $main_short_code = $before_star;

            // Characters after '*' as integer
            $short_code = intval($after_star);

            // Count the number of digits in short codes
            $digits = strlen((string)$short_code);

            //go the database check for record, if record exist?
            if(UssdGateway::where('digits', $digits)->where('main_short_code', $main_short_code)->where('short_code', $short_code)->count() > 0){
                $account = UssdGateway::where('digits', $digits)->where('main_short_code', $main_short_code)->where('short_code', $short_code)->first();

                //check if payment is active, then save session and redirect to remote url
                if(Payment::where('business_id', $account->business_id)->where('feature_id', 2)->where('end_date', '>=', Carbon::now())->count() > 0 && $account->is_active == 1){
                    return $this->remoteRedirectAirtel($jsonData, $account->destination_url);
                }else{
                    //if payment is not active, if app is not active, redirect to Ontech USSD Menu
                }
            }else{
                //if record doesnt exist/ app is in sandbox mode, redirect to Ontech USSD Menu
            }
        }else{
            //session continues
        }
    }

    public function zamtel(Request $request)
    {
        Log::info('from ZAMTEL',["request" => $request]);

        $session_id = $_GET['TransId'];
        $pid = $_GET['Pid'];
        $request_type = $_GET['RequestType'];
        $phone = $_GET['MSISDN'];
        $shortcode = $_GET['SHORTCODE'];
        $api_id = $_GET['AppId'];
        $msg = $_GET['USSDString'];

        $jsonData = array("REQUEST_TYPE" => $request_type,
            "SESSION_ID" => $session_id,
            "MESSAGE" => $msg,
            "MSISDN" => $phone);

        Log::info('from ZAMTEL',["request" => $jsonData]);

        $jsonDataEncoded = json_encode($jsonData);

        $url = "http://196.13.104.121:8001/v1/ussd";
        //$url = "http://172.16.200.10:8001/v1/ussd";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $result = curl_exec($ch);
        $result = json_decode($result);

        $ussd_body = "Coming Soon";
        $request_type = "3";

        if (!empty($result)) {
            $ussd_body = $result->ussd_response->USSD_BODY;
            $request_type = $result->ussd_response->REQUEST_TYPE;
        }

        $message_to_zamtel = $ussd_body;

        if ($request_type == "1") { //initiate
            $return_type = "";
        } else if ($request_type == "2") { //continue
            $return_type = "2";
        } else if ($request_type == "3") { //Close session
            $return_type = "3";
        }

        return $response = "?TransId=" . $session_id . "&Pid=" . $pid . "&RequestType=".$return_type."&MSISDN=" . $phone . "&SHORTCODE=" . $shortcode . "&AppId=" . $api_id . "&USSDString=" . $message_to_zamtel;
    }

    function remoteRedirectAirtel($jsonData, $remote_url){
        $jsonDataEncoded = json_encode($jsonData);

        $url = $remote_url;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $result = curl_exec($ch);
        Log::info('Remote Response',["request" => $result]);
        $result = json_decode($result);

        $ussd_body = "Coming Soon";
        $request_type = "3";

        if(curl_errno($ch)) {
            Log::info('Curl error:',["error" => curl_error($ch)]);
        }

        if (!empty($result)) {
            $ussd_body = $result->ussd_response->USSD_BODY;
            $request_type = $result->ussd_response->REQUEST_TYPE;
        }

        $message_to_mtn = $ussd_body;

        if ($request_type == "1") { //initiate
            $request_type = "2";
        } else if ($request_type == "2") { //continue
            $request_type = "FC";
        } else if ($request_type == "3") { //Close session
            $request_type = "FB";
        }

        $headers = [
            "charge:N",
            "Content-Length: 100",
            "Content-Type: UTF-8",
            "Cache-Control: max-age=0",
            "Pragma: no-cache",
            "Expires: -1",
            "amount: 0",
            "cpRefId: " . time(),
            "Freeflow: " . $request_type,
        ];

        $response = response($message_to_mtn);

        foreach ($headers as $header) {
            $headerParts = explode(':', $header, 2);
            if (count($headerParts) === 2) {
                $response->header(trim($headerParts[0]), trim($headerParts[1]));
            }
        }

        return $response;
    }

    function ussdSession(): void
    {

    }

}
