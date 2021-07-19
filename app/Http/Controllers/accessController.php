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
    
    function employees(request $r){

    function employees(){
      $data['body'] = employee::all();
      
      
      $temp = DB::table('employees');
      // gender filter
      if(isset($r->male) != isset($r->female)){
        $filter = isset($r->female) ? $r->female : $r -> male;
        $temp = $temp -> where('gender', $filter);
      }
        

      $data['body'] = $temp -> get();

      foreach ($data['body'] as $value) {
        // get employee's department
        $temp = deptEmp::where('empNo', $value->id) -> orderBy('fromDate', 'desc') -> first();
        if($temp)
          $value->dept = department::find($temp -> deptNo)->deptName;
        else
          $value->dept = __('employees.noDept');

        // get employee's title
        $temp = title::where('empNo', $value->id) -> orderBy('fromDate', 'desc') -> first();
        if($temp)
          $value->title = $temp->title;
        else
          $value->title = __('employees.noTitle');

        // get employee's salary
        $temp = salary::where('empNo', $value->id) -> orderBy('fromDate', 'desc') -> first();
        if($temp)
          $value->salary = $temp->salary;
        else
          $value->salary = __('employees.noSalary');
      }

      $data['departments'] = [];
      foreach (department::all() as $d)
        array_push( $data['departments'], array( 'value' => $d->deptNo, 'name' => $d->deptName));


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
        
      $data['employees'] = [];
      foreach (employee::all() as $e)
        array_push( $data['employees'], array( 'value' => $e->id, 'name' => $e -> firstName . " " . $e -> lastName ) );
      
      $data['departments'] = [];
      foreach (department::all() as $d)
        array_push( $data['departments'], array( 'value' => $d->deptNo, 'name' => $d->deptName));

      return self::redirect('managers', $data);
    }
    
    function departments(){
      $data['body'] = department::all();
      
      return self::redirect('departments', $data);
    }
    
    function titles(){
      $data['body'] = title::all();

      $data['employees'] = [];

      foreach ($data['body'] as $value) {
        $temp = employee::find($value->empNo);

        $value->empNo = $temp->firstName . " " . $temp -> lastName;

        if($value -> toDate == null)
          $value -> toDate = __('titles.now');

      }

      foreach (employee::all() as $e)
        array_push( $data['employees'], array( 'value' => $e->id, 'name' => $e -> firstName . " " . $e -> lastName ) );

      return self::redirect('titles', $data);
    }
    
    function salaries(){
      $data['body'] = salary::all();

      foreach($data['body'] as $d){
        $temp = employee::find($d->empNo);
        $d->empNo = $temp -> firstName . " " . $temp -> lastName;
        if(! $d->toDate)  
          $d->toDate = __('salaries.now');
      }

      $data['employees'] = [];

      foreach (employee::all() as $e)
        array_push( $data['employees'], array( 'value' => $e->id, 'name' => $e -> firstName . " " . $e -> lastName ) );

        return self::redirect('salaries', $data);
      }
      
      function deptEmp(){
      $data['body'] = deptEmp::all();
      
      $data['employees'] = [];
      foreach (employee::all() as $e)
        array_push( $data['employees'], array( 'value' => $e->id, 'name' => $e -> firstName . " " . $e -> lastName ) );
      
      $data['departments'] = [];
      foreach (department::all() as $d)
        array_push( $data['departments'], array( 'value' => $d->deptNo, 'name' => $d->deptName));
        
      foreach($data['body'] as $d){
        $d->deptNo = department::where('deptNo', $d->deptNo) -> first() -> deptName;
        $temp = employee::find($d->empNo);
        $d->empNo = $temp -> firstName . " " . $temp -> lastName;

        if($d -> toDate == null)
          $d -> toDate = __('deptEmp.now');
      }
  
      return self::redirect('deptEmp', $data);
    }
}
