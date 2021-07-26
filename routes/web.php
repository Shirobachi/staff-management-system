<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\accessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;

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
  Route::post('', [accessController::class, 'filterEmployees']);
  Route::get('{mode}/{id}', [EmployeeController::class, 'index']);  
});

Route::get('dashboard/deptManagers', [accessController::class, 'deptManagers']) -> name('deptManagers');  
Route::get('dashboard/departments', [accessController::class, 'departments']) -> name('departments');  
Route::get('dashboard/titles', [accessController::class, 'titles']) -> name('titles');  
Route::get('dashboard/salaries', [accessController::class, 'salaries']) -> name('salaries');  
Route::get('dashboard/deptEmp', [accessController::class, 'deptEmp']) -> name('deptEmp');  