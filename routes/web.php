<?php

use App\Http\Controllers\userController;
use App\Http\Middleware\tokenVerficationMiddleware;
use Illuminate\Support\Facades\Route;



// Page Routes
Route::controller(userController::class)->group(function () {
    Route::get('/login', 'loginPage');
    Route::get('/register', 'registerPage');
    Route::get('/send-otp', 'sendOtpPage');
    Route::get('/verify-otp', 'verifyOtpPage');
    Route::get('/reset-password', 'resetPasswordPage');
});

// API Routes
Route::controller(userController::class)->group(function () {
    Route::post('/user-register', 'userRegistration');
    Route::post('/user-login', 'userLogin');
    Route::post('/send-otp', 'sendOTPCode');
    Route::post('/verify-otp', 'verifyOTPCode');

    // Verify Token
    Route::post('/reset-password', 'resetPassword')
        ->middleware(tokenVerficationMiddleware::class);
});