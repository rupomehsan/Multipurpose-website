<?php

namespace App\Http\Controllers;

use App\Helpers\FlashMsg;
use App\Models\PaymentLogs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;
use Modules\Product\Entities\ProductOrder;

class BkashTokenizePaymentController extends Controller
{
    protected $app_username;
    protected $app_password;
    protected $app_secret;
    protected $app_key;

    /* get app id */
    private function getAppKey()
    {
        return $this->app_key;
    }
    /* set app key */
    public function setAppKey($app_key)
    {
        $this->app_key = $app_key;
        return $this;
    }
    /* set app id */
    public function setAppUsername($app_username)
    {
        $this->app_username = $app_username;
        return $this;
    }
    /* set app password */
    public function setAppPassword($app_password)
    {
        $this->app_password = $app_password;
        return $this;
    }
    /* set app secret */
    public function setAppSecret($app_secret)
    {
        $this->app_secret = $app_secret;
        return $this;
    }
    /* get app id */
    private function getAppUsername()
    {
        return $this->app_username;
    }
    /* get app password */
    private function getAppPassword()
    {
        return $this->app_password;
    }
    /* get secret key */
    private function getAppSecret()
    {
        return $this->app_secret;
    }
    public function index()
    {
        return view('bkashT::bkash-payment');
    }

    public function charge_amount($amount)
    {
        return $amount;
    }

    public function charge_customer($args)
    {    
        $charge_amount = $this->charge_amount($args['amount']);
        $order_id = random_int(11111, 99999) . $args['order_id'] . random_int(11111, 99999);
        return $this->createPayment(new Request([
            "intent" => $args["title"],
            "cancel_url" => $args["cancel_url"],
            "success_url" => $args["success_url"],
            'user' => Str::slug($args['name']),
            'mobile_number' => random_int(99999999, 99999999),
            'email' => $args['email'],
            'amount' => number_format((float) $charge_amount, 2, '.', ''),
            'callbackURL' => $args['ipn_url'],
        ]));
    }
    public function createPayment(Request $request)
    {

        $inv = uniqid();
        $request['intent'] = 'sale';
        $request['mode'] = '0011'; //0011 for checkout
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
        $request['merchantInvoiceNumber'] = $inv;
        $request['callbackURL'] = config("bkash.callbackURL");

        $request_data_json = json_encode($request->all());

        $response = BkashPaymentTokenize::cPayment($request_data_json);

        if ($response["statusCode"] == "9999") {
            return back()->with(FlashMsg::explain('danger', "Something went wrong. Please try again later."));
        }
        // dd($response);
        //$response =  BkashPaymentTokenize::cPayment($request_data_json,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..

        //store paymentID and your account number for matching in callback request
        // dd($response) //if you are using sandbox and not submit info to bkash use it for 1 response
        // $response['bkashURL'] = $response['bkashURL'].'&success_url='.$request->success_url;
        session()->put("bkash_success_url", $request->success_url);
        session()->put("bkash_cancel_url", $request->cancel_url);

        if (isset($response['bkashURL'])) {
            return redirect()->away($response['bkashURL']);
        } else {
            return redirect()->back()->with('error-alert2', $response['statusMessage']);
        }

    }

    public function callBack(Request $request)
    {
        
        config()->set("bkash.bkash_app_key", session('bkash_app_key'));
        config()->set("bkash.bkash_app_secret", session('bkash_app_secret'));
        config()->set("bkash.bkash_username", session('bkash_username'));
        config()->set("bkash.bkash_password", session('bkash_password'));
        config()->set('bkash.sandbox', session('sandbox'));

        //callback request params
        // paymentID=your_payment_id&status=success&apiVersion=1.2.0-beta

        //using paymentID find the account number for sending params

        // dd($request->all());
        if ($request->status == 'success') {
            $response = BkashPaymentTokenize::executePayment($request->paymentID);

            
            //$response = BkashPaymentTokenize::executePayment($request->paymentID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            if (!$response) { //if executePayment payment not found call queryPayment
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
                //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            }

            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                /*
                 * for refund need to store
                 * paymentID and trxID
                 * */
                $success_url = session("bkash_success_url");
                session()->forget(["bkash_success_url", "bkash_cancel_url"]);
                BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
                sleep(2);

                $paymentDetails = session('bkash_payment_details');

                if ($paymentDetails['payment_for'] == 'landlord') {
                    PaymentLogs::find($paymentDetails['payment_id'])->update([
                        'transaction_id' => $response['trxID'],
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

                return redirect()->away($success_url);
            }
            return BkashPaymentTokenize::failure($response['statusMessage']);
        } else if ($request->status == 'cancel') {
            $cancel_url = session("bkash_cancel_url");
            session()->forget(["bkash_success_url", "bkash_cancel_url"]);
            BkashPaymentTokenize::cancel('Your payment is canceled');
            return redirect()->away($cancel_url);
        } else {
            
            return BkashPaymentTokenize::failure('Your transaction is failed');
        }
    }

    public function searchTnx($trxID)
    {
        //response
        return BkashPaymentTokenize::searchTransaction($trxID);
        //return BkashPaymentTokenize::searchTransaction($trxID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }

    public function refund(Request $request)
    {
        $paymentID = 'Your payment id';
        $trxID = 'your transaction no';
        $amount = 5;
        $reason = 'this is test reason';
        $sku = 'abc';
        //response
        return BkashRefundTokenize::refund($paymentID, $trxID, $amount, $reason, $sku);
        //return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
    public function refundStatus(Request $request)
    {
        $paymentID = 'Your payment id';
        $trxID = 'your transaction no';
        return BkashRefundTokenize::refundStatus($paymentID, $trxID);
        //return BkashRefundTokenize::refundStatus($paymentID,$trxID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
}
