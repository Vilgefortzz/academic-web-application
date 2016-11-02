<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Session;

class AuthController extends Controller
{

    public function login(){

        return view ('auth.login');

    }

    public function handleLogin(Request $request){

        $data1 = $request->only('email', 'password');
        $data2 = $request['choice']; // value from selected radio button

        if ($data2 === 'student'){

            if (Auth::guard('student')->attempt($data1))
                return Redirect::intended('/students/'. Auth::guard('student')->user()->id . '/home');

        }
        elseif ($data2 === 'teacher'){

            if (Auth::guard('teacher')->attempt($data1))
                return Redirect::intended('/teachers/'. Auth::guard('teacher')->user()->id . '/home');

        }

        Session::flash('error', 'Incorrect email or password. Try again');
        return Redirect::intended('/login')->withInput();
    }

    public function handleLogout(){

        if (Auth::guard('student')->check()){

            Auth::guard('student')->logout();
            return Redirect::to('/');
        }

        elseif (Auth::guard('teacher')->check()){

            Auth::guard('teacher')->logout();
            return Redirect::to('/');
        }
    }
}
