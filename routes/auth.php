<?php

use App\Http\Controllers\Auth\forgetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\GoogleAuthController;





Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/users', [UserController::class, 'store']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/users/authenticate', [UserController::class, 'authenticate']);



Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);


Route::get('/forget-password', [forgetPasswordController::class, 'forgetPassword'])->name('forgetPassword');
Route::post('/forget-password', [forgetPasswordController::class, 'forgetPasswordPost'])->name('forgetPasswordPost');
Route::get('/resat-password/{token}', [forgetPasswordController::class, 'resatPassword'])->name('resatPassword');
Route::post('/resat-password', [forgetPasswordController::class, 'resatPasswordPost'])->name('resatPasswordPost');