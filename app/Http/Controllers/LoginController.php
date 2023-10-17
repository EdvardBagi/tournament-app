<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index()
    {
        return view('login');
    }
    function checkLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password'  => 'required|alphaNum|min:3'
        ]);

        $user_data = array(
            'email'  => $request->get('email'),
            'password' => $request->get('password')
        );

        if(Auth::attempt($user_data))
        {
            //print(Auth::check());
            return redirect('/');
        }
        else
        {
            return back()->with('error', 'Wrong Login Details');
        }
    }
    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
