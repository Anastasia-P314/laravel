<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Controllers\UserController;



Route::get('/', [UserController::class, 'all']);

Route::get('/register', [UserController::class, 'register']);

Route::post('/register_check', [UserController::class, 'register_check']);

Route::get('/login', [UserController::class, 'login']);

Route::post('/login_check', [UserController::class, 'login_check']);

Route::get('/logout', [UserController::class, 'logout']);

Route::get('/create', [UserController::class, 'create']);

Route::post('/store', [UserController::class, 'store']);

Route::get('/edit/{id}', [UserController::class, 'edit']);

Route::post('/update/{id}', [UserController::class, 'update']);

Route::get('/security/{id}', [UserController::class, 'security']);

Route::get('/status/{id}', [UserController::class, 'status']);

Route::post('/update_status/{id}', [UserController::class, 'update_status']);

Route::get('/media/{id}', [UserController::class, 'media']);

Route::post('/update_media/{id}', [UserController::class, 'update_media']);

Route::get('/delete/{id}', [UserController::class, 'delete']);