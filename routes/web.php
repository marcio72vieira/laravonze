<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () { return view('welcome'); }); */

// Login - Lougout
Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process');
Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy');
Route::get('/create-user-login', [LoginController::class, 'create'])->name('login.create-user');
Route::post('/store-user-login', [LoginController::class, 'store'])->name('login.store-user');

// Recupear senha
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPassword'])->name('forgot-password.show');
Route::post('/forgot-password', [ForgotPasswordController::class, 'submitForgotPassword'])->name('forgot-password.submit');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPassword'])->name('reset-password.submit');



// Rotas restritas (deve-se está autenticado)
Route::group(['middleware' => 'auth'], function(){

    // Dashboard
    Route::get('/index-dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Perfil
    Route::get('/show-profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/update-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/edit-profile-password', [ProfileController::class, 'editPassword'])->name('profile.edit-password');
    Route::put('/update-profile-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // Usuários
    Route::get('/index-user', [UserController::class, 'index'])->name('user.index');
    Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
    Route::post('/store-user', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('/edit-user-password/{user}', [UserController::class, 'editPassword'])->name('user.edit-password');
    Route::put('/update-user-password/{user}', [UserController::class, 'updatePassword'])->name('user.update-password');
    Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    // Courses
    Route::get('/index-course', [CourseController::class, 'index'])->name('course.index');
    Route::get('/show-course/{course}', [CourseController::class, 'show'])->name('course.show');
    Route::get('/create-course', [CourseController::class, 'create'])->name('course.create');
    Route::post('/store-course', [CourseController::class, 'store'])->name('course.store');
    Route::get('/edit-course/{course}', [CourseController::class, 'edit'])->name('course.edit');
    Route::put('/update-course/{course}', [CourseController::class, 'update'])->name('course.update');
    Route::delete('/destroy-course/{course}', [CourseController::class, 'destroy'])->name('course.destroy');


    // Classes
    Route::get('/index-classe/{course}', [ClasseController::class, 'index'])->name('classe.index');
    Route::get('/create-classe/{course}', [ClasseController::class, 'create'])->name('classe.create');
    Route::get('/show-classe/{classe}', [ClasseController::class, 'show'])->name('classe.show');
    Route::post('/store-classe', [ClasseController::class, 'store'])->name('classe.store');
    Route::get('/edit-classe/{classe}', [ClasseController::class, 'edit'])->name('classe.edit');
    Route::put('/update-classe/{classe}', [ClasseController::class, 'update'])->name('classe.update');
    Route::delete('/destroy-classe/{classe}', [ClasseController::class, 'destroy'])->name('classe.destroy');

});

