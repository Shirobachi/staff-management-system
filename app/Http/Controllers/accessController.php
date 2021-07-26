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
use Carbon\Carbon;

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

    function redirect($name, $data, $title = ""){
      if(session()->has('userID')){
        return view('listing', compact('name', 'data', 'title'));
      }
      else{
        $info['desc'] = __('auth.401');
        $info['type'] = 'danger';

        return view('auth.login', compact('info'));
      }
    }

    function employees($gender = false, $salaryMin = false, $salaryMax = false, $dept = false){  

      $data['body'] = employee::_get($gender, $salaryMin, $salaryMax, $dept);
    
      foreach($data['body'] as $d)
        $d -> gender = __('employees.' . $d -> gender);

        $data['dept'] = department::select('deptNo', 'deptName') -> get();

      return self::redirect('employees', $data);
    }

    function filterEmployees(request $r){

      $r->validate([
      'salaryMin' => 'integer|nullable',
      'salaryMax' => 'integer|nullable'
      ]);

      $gender = isset($r->male) == isset($r->female) ? false : (isset($r->male) ? $r->male : $r->female);
      $salaryMin = isset($r->salaryMin) ? $r->salaryMin : false;
      $salaryMax = isset($r->salaryMax) ? $r->salaryMax : false;
      $dept = !isset($r->deptNo) || $r->deptNo == "NULL" ? false: $r->deptNo;

      return self::employees($gender, $salaryMin, $salaryMax, $dept);
    }
      
    function departments(){
      $data['body'] = department::_get();

      return self::redirect('departments', $data);
    }

    function deptEmp(){
      $data['body'] = deptEmp::_get();

      return self::redirect('deptEmp', $data, "Employee's departments");
    }

    function deptManagers(){
      $data['body'] = deptManager::_get();

      return self::redirect('deptManagers', $data, "Department's managers");
    }

    function salaries(){
      $data['body'] = salary::_get();

      return self::redirect('salaries', $data);
    }

    function titles(){
      $data['body'] = title::_get();

      return self::redirect('titles', $data);
    }
}