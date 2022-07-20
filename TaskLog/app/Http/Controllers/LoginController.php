<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
   public function index(){
    return view('loginform');
   }
   public function dologin(Request $request){
    $email = $request->email;
    $password = $request->pswd;
    if (Auth::attempt(array('email' => $email, 'password' => $password))){
        return redirect()->route('homepage');
    }
    else {        
        return redirect('/')->with('message', 'Invalid Details');;
    }

   }
}
