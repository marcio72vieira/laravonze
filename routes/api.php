<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/user', [UserController::class, 'index']);          // http://localhost:8080/api/user?page=1
Route::get('/user/{user}', [UserController::class, 'show']);    // http://localhost:8080/api/user/1
Route::post('/user', [UserController::class, 'store']);         // http://localhost:8080/api/user
