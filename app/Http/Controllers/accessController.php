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
    
    function _employees(){
      $data['body'] = employee::all();

      foreach ($data['body'] as $value) {
        // get employee's department
        $temp = deptEmp::where('empNo', $value->id) -> orderBy('fromDate', 'desc') -> first();
        if($temp){
          $value->dept = department::find($temp -> deptNo)->deptName;
          $value->deptNo = $temp->deptNo;
        }
        else{
          $value->dept = __('employees.noDept');
          $value->deptNo = null;
        }

        // get employee's title
        $temp = title::where('empNo', $value->id) -> orderBy('fromDate', 'desc') -> first();
        if($temp)
          $value->title = $temp->title;
        else
          $value->title = __('employees.noTitle');

        // get employee's salary
        $temp = salary::where('empNo', $value->id) -> orderBy('fromDate', 'desc') -> first();
        if($temp){
          $value->salary = $temp->salary;
          $value->typeEmp = ! $temp -> toDate ? 'C' : 'P';
        }
        else{
          $value->salary = __('employees.noSalary');
          $value->typeEmp = 'P';
        }
      }

      $data['departments'] = [];
      foreach (department::all() as $d)
        array_push( $data['departments'], array( 'value' => $d->deptNo, 'name' => $d->deptName));
      
      return $data;
    }

    function employees(){
      $data = self::_employees();
      
      return self::redirect('employees', $data);
    }
    
    function employeesFilter(request $r){
      $data = self::_employees();

      // Filtering
      foreach ($data['body'] as $key => $value) {
        // Employee's type
        if(isset($r->pastEmployee) != isset($r->currentEmployee)){
          $tmp = isset($r->currentEmployee) ? 'C' : 'P';

          if($value -> typeEmp != $tmp)
            unset($data['body'][$key]);
        }

        // Employee's gender
        if(isset($r->male) != isset($r->female)){
          $tmp = isset($r->male) ? $r->male : $r->female;

          // dump($tmp, $value->gender);
          if($value->gender != $tmp)
            unset($data['body'][$key]);
        }
          
        //salary
        if((isset($r->salaryMin) && isset($r->salaryMax) && $value->salary > $r->salaryMax || $value->salary < $r->salaryMin) || 
            (isset($r->salaryMin) && !isset($r->salaryMax) && $value->salary < $r->salaryMin) ||
            (!isset($r->salaryMin) && isset($r->salaryMax) && $value->salary > $r->salaryMax))
          unset($data['body'][$key]);
          
        //department
        if(isset($r->deptNo) && $r->deptNo != "NULL" && $value->deptNo != $r->deptNo)
          unset($data['body'][$key]);
      }

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
