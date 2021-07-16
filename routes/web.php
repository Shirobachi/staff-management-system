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
});