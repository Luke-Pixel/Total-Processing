<?php

namespace App\Http\Controllers\Refund;

use Session;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RefundController extends Controller
{

    
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function store(Request $request){

        //verif input
        $this->validate($request, [
            'refundamount' => 'required|gt:0'
        ]);
        
        //check refund amount
        $payment = DB::table('payments')->where('payment_id', Session::get('payment_id') )->first();
        //if refunnd amount invalid display error 
        if(($request->input('refundamount') + $payment->refunded) > $payment->amount){
            return back()->with('status', 'Refund cannot be more than outstanding amount');
        }

        //process refund    
        $url = "https://test.oppwa.com/v1/payments/".Session::get('payment_id');
        
        $data = "entityId=8ac7a4ca759cd78501759dd759ad02df" .
                    "&amount=10.00" .
                    "&currency=EUR" .
                    "&paymentType=RF";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGFjN2E0Y2E3NTljZDc4NTAxNzU5ZGQ3NThhYjAyZGR8NTNybThiSmpxWQ=='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        //save refund result
        Session::put('refundResponse', json_decode($responseData,true));
        if(Session::get('refundResponse')['result']['code'] == '000.100.110'){
            DB::update('update payments set refunded = ? where payment_id = ?', [($request->input('refundamount') + $payment->refunded),$payment->payment_id]); 
        }

        //display refund status
        return redirect()->route('refundstatus');
    }
}
