<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(){
        return view('login');
    }

    public function auth(Request $request)
    {
        $formFields=$request->validate([
            "employeeid" => "required",
            "password" => "required"
        ]);

        if (Auth::attempt($formFields)) {
            $request->session()->regenerate();
            if(Auth::user()->is_cashier === 1){

                $user = Auth::user()->employeeid;
                $message = "{$user} has logged in";

                logging($user,$message);

                return redirect()->intended('/');
            };
            if(Auth::user()->is_cashier === 0){
                return redirect()->intended('/waiter');
            };
        }
        else{
            return response()->json("You are not authorized");
        }
    }


    public function logout(Request $request)
    {
        $user = Auth::user()->employeeid;
        $message = "{$user} attempts to log out";

        logging($user,$message);

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message',"You've been logged out");
    }

}
