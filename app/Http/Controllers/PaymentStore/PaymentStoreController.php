<?php

namespace App\Http\Controllers\PaymentStore;

use Session;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\PaymentController;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;


//retrieve stored payments and go to view payment history page 
class PaymentStoreController extends Controller
{

    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){

        //retrieve payments for current user
        $payments = Payment::select("*")
                        ->where("user_id", "=", auth()->user()->id)
                        ->get();

        return view('payment.paymentview' , [
            'payments' => $payments
        ]);
    }

    
}
