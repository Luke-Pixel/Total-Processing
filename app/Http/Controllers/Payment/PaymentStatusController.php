<?php

namespace App\Http\Controllers\Payment;

use Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentStatusController extends Controller
{   

    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(Request $request){
        
        //process payment 
        $url = "https://test.oppwa.com/v1/checkouts/" .Session::get('response')['id']. "/payment";
        $url .= "?entityId=8ac7a4ca759cd78501759dd759ad02df";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGFjN2E0Y2E3NTljZDc4NTAxNzU5ZGQ3NThhYjAyZGR8NTNybThiSmpxWQ=='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        
        Session::put('paymentResponse', json_decode($responseData,true));
        //if payment sucessful, store details of payment
        if(Session::get('paymentResponse')['result']['code'] == "000.100.110"){
            //store transaction
            $request->user()->payments()->create([
                'refrence' => Session::get('refrence'),
                'amount' => Session::get('amount'),
                'refunded' => 0,
                'payment_id' => Session::get('paymentResponse')['id']
                ]);
            }
            
        //displayy payment status page 
        return view('payment.paymentstatus');
    }

    public function store( Request $request ){

        $url = "https://test.oppwa.com/v1/checkouts/" .Session::get('response')['id']. "/payment";
        $url .= "?entityId=8ac7a4ca759cd78501759dd759ad02df";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGFjN2E0Y2E3NTljZDc4NTAxNzU5ZGQ3NThhYjAyZGR8NTNybThiSmpxWQ=='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        
        Session::put('paymentResponse', json_decode($responseData,true));
        //dd($request);

            
            $request->user()->payments()->create([
                'refrence' => Session::get('refrence'),
                'amount' => Session::get('amount'),
                'refunded' => 0,
                'payment_id' => Session::get('response')['id']
                ]);
            
                
        return view('payment.paymentstatus');

        
    }

    
}
