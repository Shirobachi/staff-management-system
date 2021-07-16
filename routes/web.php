<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\accessController;
use App\Http\Controllers\UserController;


Route::get('/', [accessController::class, 'login']);
Route::get('register', [accessController::class, 'register']);

Route::post('register', [UserController::class, 'create']);