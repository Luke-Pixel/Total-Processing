<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store(){
        //log user out
        auth()->logout();
        //go to login page
        return redirect()->route('login');
    }
}
