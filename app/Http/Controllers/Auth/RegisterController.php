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
            
        //check user exists
        $users = User::select("*")
                        ->where("email", "=", strtolower($request->email))
                        ->get();
        if($users->count()){
            return back()->with('status', 'User alread exists');
        }

        

        //store new user
        User::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' =>Hash::make($request->password)

        ]);

        //login new user
        auth()->attempt($request->only('email','password'));

        //redirect to new payment page 
        return redirect()->route('payment');
    }
}
