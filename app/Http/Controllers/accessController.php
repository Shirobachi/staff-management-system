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
      $data['body'] = DB::table('employees') 
      -> leftJoin('titles', 'titles.empNo', 'employees.id')
      -> leftJoin('deptEmp', 'deptEmp.empNo', 'employees.id')
      -> leftJoin('departments', 'departments.deptNo', 'deptEmp.deptNo')
      -> leftJoin('salaries', 'salaries.empNo', 'employees.id')
      -> orderBy('employees.id')
      -> select('employees.id', 'firstName', 'lastName', 'birthDate', 'gender', 'title', 'deptName', 'salary', 'hireDate') 
      -> where('deptEmp.toDate', '>=', Carbon::now())
      -> where('salaries.toDate', '>=', Carbon::now())
      -> where('titles.toDate', '>=', Carbon::now())
      -> when($gender, function ($query, $gender) {
          return $query->where('employees.gender', $gender);
        })
      -> when($salaryMin, function ($query, $salaryMin) {
          return $query->where('salaries.salary', '>=', $salaryMin);
        })
        -> when($salaryMax, function ($query, $salaryMax) {
          return $query->where('salaries.salary', '<=', $salaryMax);
        })
        -> when($dept, function ($query, $dept) {
          return $query->where('deptEmp.deptNo', $dept);
        })
      ->paginate(env('PAGINATE', env('PAGINATE', 25)));
    
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
      $data['body'] = DB::table('departments') 
        -> orderBy('deptNo')
        -> select('deptNo', 'deptName') 
        -> paginate(env('PAGINATE', 25));

      return self::redirect('departments', $data);
    }

    function deptEmp(){
      $data['body'] = DB::table('deptEmp') 
        -> leftJoin('employees', 'employees.id', 'deptEmp.empNo') 
        -> leftJoin('departments', 'departments.deptNo', 'deptEmp.deptNo') 
        -> select('firstName', 'lastName', 'deptName', 'fromDate', 'toDate')
        -> paginate(env('PAGINATE', 25));

      return self::redirect('deptEmp', $data, "Employee's departments");
    }

    function deptManagers(){
      $data['body'] = DB::table('deptManagers') 
        -> leftJoin('employees', 'employees.id', 'deptManagers.empNo') 
        -> leftJoin('departments', 'departments.deptNo', 'deptManagers.deptNo') 
        -> orderBy('employees.lastName')
        -> orderBy('employees.firstName')
        -> select('firstName', 'lastName', 'deptName', 'fromDate', 'toDate')
        -> paginate(env('PAGINATE', 25));

      return self::redirect('deptManagers', $data, "Department's managers");
    }

    function salaries(){
      $data['body'] = DB::table('salaries') 
        -> orderBy('fromDate')
        -> leftJoin('employees', 'employees.id', 'salaries.empNo') 
        -> select('firstName', 'lastName', 'salary', 'fromDate', 'toDate')
        -> paginate(env('PAGINATE', 25));

      return self::redirect('salaries', $data);
    }

    function titles(){
      $data['body'] = DB::table('titles') 
        -> orderBy('fromDate')
        -> leftJoin('employees', 'employees.id', 'titles.empNo') 
        -> select('firstName', 'lastName', 'title', 'fromDate', 'toDate')
        -> paginate(env('PAGINATE', 25));

      return self::redirect('titles', $data);
    }
}