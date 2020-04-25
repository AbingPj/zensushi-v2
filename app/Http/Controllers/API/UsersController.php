<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getUsers(){

        if(Auth::user()->role_id == 1){
            $users = User::with('role')->get();
            return response()->json($users, 200);
        }else{
            $message = "Unauthorized";
            return response()->json($message, 403);
        }


    }
}
