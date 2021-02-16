<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //goto new payment page if already authenticated
    public function __construct(){
        $this->middleware(['guest']);
    }

    public function index(){
        return view('auth.login');
    }

    //validate input from user
    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //login faileure -> reload page and display Invalid login
        if(!auth()->attempt($request->only('email','password'))){
            return back()->with('status', 'Invalid login details');
        }

        //redirect to new payment after login
        return redirect()->route('payment');
    }
}
