<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get("register", [AuthController::class,"register"]);
Route::get("login", [AuthController::class,"login"]);

Route::group([
    "middleware" => ["auth:sanctum"]
], function (){
    Route::get('/accept', [AuthController::class, 'accept']);
    Route::get('/reject', [AuthController::class, 'reject']);
    Route::get("profile", [AuthController::class,"profile"]);
    Route::get("logout",  [AuthController::class,"logout"]);
});

Route::post("status", [AuthController::class,"status"]);