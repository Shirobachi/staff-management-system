<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\accessController;
use App\Http\Controllers\UserController;


Route::get('/', [accessController::class, 'login']);
Route::get('register', [accessController::class, 'register']);

Route::post('/', [UserController::class, 'index']);
Route::post('register', [UserController::class, 'create']);

Route::get('/logout', function () {
  session()->forget('userID');
  $info['desc'] = __('auth.logOutOk');
  return view('auth.login', compact('info'));
});

Route::get(env('DASHBOARD', 'dashboard'), [accessController::class, 'employees']) -> name('dashboard');
Route::get('dashboard/managers', [accessController::class, 'managers']) -> name('managers');
Route::get('dashboard/departments', [accessController::class, 'departments']) -> name('departments');
Route::get('dashboard/titles', [accessController::class, 'titles']) -> name('titles');
Route::get('dashboard/salaries', [accessController::class, 'salaries']) -> name('salaries');


Route::get('/test', function () {
  return view('dashboard.dept');
});