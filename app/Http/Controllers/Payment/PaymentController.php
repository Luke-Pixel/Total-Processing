<?php

namespace App\Http\Controllers\Payment;

use Session;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function __construct(){
        $this->middleware(['auth']);
    }

    public function store(Request $request){

        //vslidate user input
        $this->validate($request, [
            'amount' => 'numeric|gt:0',
            'refrence' => 'required'
        ]);
        

        //if validation ok create checkout
        $url = "https://test.oppwa.com/v1/checkouts";
        $data = "entityId=8ac7a4ca759cd78501759dd759ad02df" .
                    "&amount=".$request->input('amount').
                    "&currency=EUR" .
                    "&paymentType=DB".
                    "&merchantTransactionId=".$request->input('refrence');
                    
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                       'Authorization:Bearer OGFjN2E0Y2E3NTljZDc4NTAxNzU5ZGQ3NThhYjAyZGR8NTNybThiSmpxWQ=='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        //store result and payment details for next page 
        Session::put('response', json_decode($responseData,true));
        Session::put('amount', $request->input('amount'));
        Session::put('refrence', $request->input('refrence'));

        //go to payment page
        return view('payment.paymentprocess');

    }

  
    

    
}
