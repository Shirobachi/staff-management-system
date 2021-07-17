<?php

namespace App\Http\Controllers;

use App\Models\employee;

use Illuminate\Http\Request;

class accessController extends Controller
{
    function login(){
        if(session()->has('userID'))
            return self::employees();
        else
            return view('auth.login');
    }

    function register(){
        if(session()->has('userID'))
            return self::employees();
        else
            return view('auth.register');
    }

    function redirect($path, $data = []){
      if(session()->has('userID')){
        return view('dashboard.' . $path, compact('path', 'data'));
      }
      else{
        $info['desc'] = __('auth.401');
        $info['type'] = 'danger';

        return view('auth.login', compact('info'));
      }
    }
    
    function employees(){
      $data = employee::all();

      return self::redirect('employees', $data);
    }
    
    function managers(){
      return self::redirect('managers');
    }
    
    function departments(){
      return self::redirect('departments');
    }
    
    function titles(){
      return self::redirect('titles');
    }
    
    function salaries(){
      return self::redirect('salaries');
    }
}
