<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/resend-otp', [UserController::class, 'resendOTP']);
Route::post('/verify-otp', [UserController::class, 'verifyOTP']);
