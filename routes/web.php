<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\accessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\deptManagerController;


Route::get('/', [accessController::class, 'login']);
Route::get('register', [accessController::class, 'register']);

Route::post('/', [UserController::class, 'index']);
Route::post('register', [UserController::class, 'create']);

Route::get('/logout', function () {
  session()->forget('userID');
  $info['desc'] = __('auth.logOutOk');
  return view('auth.login', compact('info'));
});


Route::prefix('dashboard/employees')->group(function () {
  Route::get('/', [accessController::class, 'employees']) -> name('employees');  
  Route::post('new', [EmployeeController::class, 'create']);  
  Route::get('/delete/{id}', [EmployeeController::class, 'destroy']);  
  Route::post('/edit/{id}', [EmployeeController::class, 'edit']);  
});
Route::prefix('dashboard/managers')->group(function () {
  Route::get('/', [accessController::class, 'managers']) -> name('managers');  
  Route::post('new', [deptManagerController::class, 'create']);  
  Route::get('/delete/{id}', [deptManagerController::class, 'destroy']);  
  Route::post('/edit/{id}', [deptManagerController::class, 'edit']);  
});
Route::prefix('dashboard/departments')->group(function () {
  Route::get('/', [accessController::class, 'departments']) -> name('departments');  
  Route::post('new', [DepartmentController::class, 'create']);  
  Route::get('/delete/{id}', [DepartmentController::class, 'destroy']);  
  Route::post('/edit/{id}', [DepartmentController::class, 'edit']);  
});
Route::prefix('dashboard/titles')->group(function () {
  Route::get('/', [accessController::class, 'titles']) -> name('titles');  
});
Route::prefix('dashboard/salaries')->group(function () {
  Route::get('/', [accessController::class, 'salaries']) -> name('salaries');  
});