<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class accessController extends Controller
{
    function login(){
        if(session()->has('userID'))
            return view('dashboard');
        else
            return view('login');
    }

    function register(){
        if(session()->has('userID'))
            return view('dashboard');
        else
            return view('register');
    }
}
