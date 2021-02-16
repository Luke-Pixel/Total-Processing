<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //goto new payment page if already authenticated
    public function __construct(){
        $this->middleware(['guest']);
    }

    public function index(){
        return view('auth.register');
    }

    public function store(Request $request ){

        //validation
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed'
        ]);

        //store new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password)

        ]);

        //login new user
        auth()->attempt($request->only('email','password'));

        //redirect to new payment page 
        return redirect()->route('payment');
    }
}
