<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class WelcomeController extends Controller
{


    // public function __construct()
    // {
    //     // $this->middleware('guest')->except('logout');
    //     $this->middleware('guest');
    // }

    public function welcome()
    {
        if(Auth::check()) {
            return redirect()->route('page.home');
        }
        return view('welcome');
    }
    public function register()
    {
        if(Auth::check()) {
            return redirect()->route('page.home');
        }
        return view('register');
    }
}
