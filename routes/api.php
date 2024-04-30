<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;


// Rute untuk register, login, dan status
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('/user', [AuthController::class, 'getUserData']);
Route::get('/status', [AuthController::class, 'checkAccountStatus'])->middleware(['auth:sanctum']);

// Rute untuk profile dan logout, yang memerlukan autentikasi
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('profile', [AuthController::class, 'profile']);
    Route::post('logout', [AuthController::class, 'logout']);
});

// Rute tambahan untuk menerima atau menolak akun
Route::get('accept-account/{id}', [AuthController::class, 'acceptAccount'])->withoutMiddleware(['auth:sanctum']);
Route::get('reject-account/{id}', [AuthController::class, 'rejectAccount'])->withoutMiddleware(['auth:sanctum']);
