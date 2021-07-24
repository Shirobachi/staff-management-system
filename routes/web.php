<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\accessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\deptManagerController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\DeptEmpController;


Route::get('', [accessController::class, 'login']);
Route::get('register', [accessController::class, 'register']);

Route::post('', [UserController::class, 'index']);
Route::post('register', [UserController::class, 'create']);

Route::get('logout', function () {
  session()->forget('userID');
  $info['desc'] = __('auth.logOutOk');
  return view('auth.login', compact('info'));
});

Route::get('dashboard/employees', [accessController::class, 'employees']) -> name('employees');  
Route::post('dashboard/employees', [accessController::class, 'filterEmployees']);
Route::get('dashboard/deptManagers', [accessController::class, 'deptManagers']) -> name('deptManagers');  
Route::get('dashboard/departments', [accessController::class, 'departments']) -> name('departments');  
Route::get('dashboard/titles', [accessController::class, 'titles']) -> name('titles');  
Route::get('dashboard/salaries', [accessController::class, 'salaries']) -> name('salaries');  
Route::get('dashboard/deptEmp', [accessController::class, 'deptEmp']) -> name('deptEmp');  