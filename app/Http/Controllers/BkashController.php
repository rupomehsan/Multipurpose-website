<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use App\Models\PaymentLogs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Product\Entities\ProductOrder;

class BkashController extends Controller
{
    private $base_url;
    private $app_key;
    private $app_secret;
    private $username;
    private $password;

    public function __construct($credentials)
    {
        // bKash Merchant API Information
        $gateway = PaymentGateway::where('name', 'bkash')->first();
        $credentials = (array) json_decode($credentials);

        // You can import it from your Database
        $bkash_app_key = $credentials['bkash_app_key']; // bKash Merchant API APP KEY
        $bkash_app_secret = $credentials['bkash_app_secret']; // bKash Merchant API APP SECRET
        $bkash_username = $credentials['bkash_username']; // bKash Merchant API USERNAME
        $bkash_password = $credentials['bkash_password']; // bKash Merchant API PASSWORD
        $bkash_base_url = ($gateway->test_mode == 0) ? 'https://checkout.pay.bka.sh/v1.2.0-beta' : "https://checkout.sandbox.bka.sh/v1.2.0-beta";

        $this->app_key = $bkash_app_key;
        $this->app_secret = $bkash_app_secret;
        $this->username = $bkash_username;
        $this->password = $bkash_password;
        $this->base_url = $bkash_base_url;
    }

    public function payWithBkash(){
        return view('components.payment.bkash.bkash');
    }
    public function getToken()
    {
        session()->forget('bkash_token');

        $post_token = array(
            'app_key' => $this->app_key,
            'app_secret' => $this->app_secret,
        );

        $url = curl_init("$this->base_url/checkout/token/grant");
        $post_token = json_encode($post_token);
        $header = array(
            'Content-Type:application/json',
            "password:$this->password",
            "username:$this->username",
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $post_token);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $resultdata = curl_exec($url);
        curl_close($url);

        $response = json_decode($resultdata, true);

        if (array_key_exists('msg', $response)) {
            return $response;
        }

        session()->put('bkash_token', $response['id_token']);

        return response()->json(['success', true]);
    }

    public function createPayment(Request $request)
    {

        if (((string) $request->amount != (string) session()->get('bkash')['invoice_amount'])) {
            return response()->json([
                'errorMessage' => 'Amount Mismatch',
                'errorCode' => 2006,
            ], 422);
        }

        $token = session()->get('bkash_token');

        $request['intent'] = 'sale';
        $request['currency'] = 'BDT';
        $request['merchantInvoiceNumber'] = uniqid();

        $url = curl_init("$this->base_url/checkout/payment/create");
        $request_data_json = json_encode($request->all());
        $header = array(
            'Content-Type:application/json',
            "authorization: $token",
            "x-app-key: $this->app_key",
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $request_data_json);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $resultdata = curl_exec($url);
        curl_close($url);
        return json_decode($resultdata, true);
    }

    public function executePayment(Request $request)
    {
        $token = session()->get('bkash_token');

        $paymentID = $request->paymentID;
        $url = curl_init("$this->base_url/checkout/payment/execute/" . $paymentID);
        $header = array(
            'Content-Type:application/json',
            "authorization:$token",
            "x-app-key:$this->app_key",
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $resultdata = curl_exec($url);
        curl_close($url);
        return json_decode($resultdata, true);
    }

    public function queryPayment(Request $request)
    {
        $token = session()->get('bkash_token');
        $paymentID = $request->payment_info['payment_id'];

        $url = curl_init("$this->base_url/checkout/payment/query/" . $paymentID);
        $header = array(
            'Content-Type:application/json',
            "authorization:$token",
            "x-app-key:$this->app_key",
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $resultdata = curl_exec($url);
        curl_close($url);
        return json_decode($resultdata, true);
    }

    public function bkashSuccess(Request $request)
    {
        // IF PAYMENT SUCCESS THEN YOU CAN APPLY YOUR CONDITION HERE

        if ($request['payment_info']['transactionStatus'] == 'Completed') {

            // THEN YOU CAN REDIRECT TO YOUR ROUTE

            $paymentDetails = session('bkash_payment_details');

            if ($paymentDetails['payment_for'] == 'landlord') {
                PaymentLogs::find($paymentDetails['payment_details']['id'])->update([
                    'transaction_id' => $request['payment_info']['trxID'],
                    'status' => 'complete',
                    'payment_status' => 'complete',
                    'updated_at' => Carbon::now(),
                ]);
            } else {
                ProductOrder::find($paymentDetails['order_id'])->update([
                    'payment_status' => 'success',
                ]);

            }
            session()->forget('bkash_payment_details');

            Session::flash('successMsg', 'Payment has been Completed Successfully');

            return response()->json(['status' => true]);
        }

        Session::flash('error', 'Noman Error Message');

        return response()->json(['status' => false]);
    }
}
