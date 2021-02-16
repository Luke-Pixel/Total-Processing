<?php

namespace App\Http\Controllers\Refund;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RefundStatus extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    //display refund result 
    public function index(){
        return view('refund.refundstatus');
    }
}
