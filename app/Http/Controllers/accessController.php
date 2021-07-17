<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\department;
use App\Models\deptManager;

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
      $data['body'] = employee::all();
      
      return self::redirect('employees', $data);
    }
    
    function managers(){
      $data['body'] = deptManager::all();

      foreach($data['body'] as $d){
        $d->deptNo = department::where('deptNo', $d->deptNo) -> first() -> deptName;
        $temp = employee::find($d->empNo);
        $d->empNo = $temp -> firstName . " " . $temp -> lastName;

        if($d -> toDate == null)
        $d -> toDate = __('managers.now');
      }
        
      $data['departments'] = [];
      $data['employees'] = [];

      foreach (employee::all() as $e)
        array_push( $data['employees'], array( 'value' => $e->id, 'name' => $e -> firstName . " " . $e -> lastName ) );

      foreach (department::all() as $d)
        array_push( $data['departments'], array( 'value' => $d->deptNo, 'name' => $d->deptName));

      // dd($data);

      return self::redirect('managers', $data);
    }
    
    function departments(){
      $data['body'] = department::all();

      return self::redirect('departments', $data);
    }
    
    function titles(){
      return self::redirect('titles');
    }
    
    function salaries(){
      return self::redirect('salaries');
    }
}
