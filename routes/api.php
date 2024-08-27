<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/user', [UserController::class, 'index']);                          // método: GET      - http://localhost:8080/api/user?page=1
Route::get('/user/{user}', [UserController::class, 'show']);                    // método: GET      - http://localhost:8080/api/user/1
Route::post('/user', [UserController::class, 'store']);                         // método: POST     - http://localhost:8080/api/user
Route::put('/user/{user}', [UserController::class, 'update']);                  // método: PUT      - http://localhost:8080/api/user/1
Route::delete('/user/{user}', [UserController::class, 'destroy']);              // método: DELETE   - http://localhost:8080/api/user/1
Route::put('/user-password/{user}', [UserController::class, 'updatePassword']); // método: PUT      - http://127.0.0.1:8000/


