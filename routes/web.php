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


Route::prefix('dashboard/employees')->group(function () {
  Route::get('', [accessController::class, 'employees']) -> name('employees');  
  Route::post('new', [EmployeeController::class, 'create']);  
  Route::get('delete/{id}', [EmployeeController::class, 'destroy']);  
  Route::post('edit/{id}', [EmployeeController::class, 'edit']);  
});
Route::prefix('dashboard/managers')->group(function () {
  Route::get('', [accessController::class, 'managers']) -> name('managers');  
  Route::post('new', [deptManagerController::class, 'create']);  
  Route::get('delete/{id}', [deptManagerController::class, 'destroy']);  
  Route::post('edit/{id}', [deptManagerController::class, 'edit']);  
});
Route::prefix('dashboard/departments')->group(function () {
  Route::get('', [accessController::class, 'departments']) -> name('departments');  
  Route::post('new', [DepartmentController::class, 'create']);  
  Route::get('delete/{id}', [DepartmentController::class, 'destroy']);  
  Route::post('edit/{id}', [DepartmentController::class, 'edit']);  
});
Route::prefix('dashboard/titles')->group(function () {
  Route::get('', [accessController::class, 'titles']) -> name('titles');  
  Route::post('new', [TitleController::class, 'create']);  
  Route::get('delete/{title}/{date}', [TitleController::class, 'destroy']);  
  Route::post('edit/{title}/{date}', [TitleController::class, 'edit']);  
});
Route::prefix('dashboard/salaries')->group(function () {
  Route::get('', [accessController::class, 'salaries']) -> name('salaries');  
  Route::post('new', [SalaryController::class, 'create']);  
  Route::get('delete/{date}', [SalaryController::class, 'destroy']);  
  Route::post('edit/{date}', [SalaryController::class, 'edit']);  
});
Route::prefix('dashboard/dept-emp')->group(function () {
  Route::get('', [accessController::class, 'deptEmp']) -> name('dept-emp');  
  Route::post('new', [DeptEmpController::class, 'create']);  
  Route::get('delete/{date}', [DeptEmpController::class, 'destroy']);  
  Route::post('edit/{date}', [DeptEmpController::class, 'edit']);  
});