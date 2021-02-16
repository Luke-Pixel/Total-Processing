<?php

namespace App\Http\Controllers\Refund;

use Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RefundPrepareController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(Request $request){
        //store entered refund and continue displayy refund page
        Session::put('payment_id',$request->refund_btn);
        return view('refund.refund');
    }
}
