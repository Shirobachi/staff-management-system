<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\department;
use App\Models\deptManager;
use App\Models\title;
use App\Models\salary;
use App\Models\deptEmp;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    function redirect($name, $data){
      if(session()->has('userID')){
        return view('listing', compact('name', 'data'));
      }
      else{
        $info['desc'] = __('auth.401');
        $info['type'] = 'danger';

        return view('auth.login', compact('info'));
      }
    }

    function employees(){
      $data['body'] = DB::table('employees') 
        -> select('id', 'birthDate', 'firstName', 'lastName', 'gender', 'hireDate') 
        ->paginate(25);

      foreach($data['body'] as $d)
        $d 
          -> gender = __('employees.' . $d
          ->gender);

      return self::redirect('employees', $data);
    }

    function departments(){
      $data['body'] = DB::table('departments') 
        -> select('deptNo', 'deptName') 
        -> paginate(25);

      return self::redirect('departments', $data);
    }

    function deptEmp(){
      $data['body'] = DB::table('deptEmp') 
        -> leftJoin('employees', 'employees.id', 'deptEmp.empNo') 
        -> leftJoin('departments', 'departments.deptNo', 'deptEmp.deptNo') 
        -> select('firstName', 'lastName', 'deptName', 'fromDate', 'toDate')
        -> paginate(25);

      return self::redirect('deptEmp', $data);
    }

    function deptManagers(){
      $data['body'] = DB::table('deptManagers') 
        -> leftJoin('employees', 'employees.id', 'deptManagers.empNo') 
        -> leftJoin('departments', 'departments.deptNo', 'deptManagers.deptNo') 
        -> select('firstName', 'lastName', 'deptName', 'fromDate', 'toDate')
        -> paginate(25);
        // -> first();

        // dd($data['body']);

      return self::redirect('deptManagers', $data);
    }
}