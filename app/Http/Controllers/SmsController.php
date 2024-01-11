<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function sms_send(Request $request)
    {
        // generate otp 
        $otp = rand(100000, 999999);
        // store otp in session
        session()->put('otp', $otp);
        session()->put('phone_number', $request->phone);

        return ["message_id"=>$otp];
        // send sms
        
        $url = "https://bulksmsbd.net/api/smsapi";
        $api_key = env('BULKSMSBD_API_KEY');
        $senderid = env('BULKSMSBD_SENDER_ID');
        $number = $request->phone;

        $message = "Your OTP is: " . $otp;

        $data = [
            "api_key" => $api_key,
            "senderid" => $senderid,
            "number" => $number,
            "message" => $message,
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    public function verifyOtp(Request $request)
    {
        $otp = $request->otp;
        $session_otp = session('otp');
        if ($otp == $session_otp) {
            session()->forget("otp");
            return ['status' => true,'message' => "OTP verified successfully"];
        } else {
            return ['status' => false, 'message' => "OTP verification failed"];
        }
    }
    public function sendAgain(){
        $phoneNumber = session('phone_number');
        return $this->sms_send(new Request($phoneNumber));
    }

}
