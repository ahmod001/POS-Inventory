<?php

use App\Http\Controllers\categoryController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\productController;
use App\Http\Controllers\userController;
use App\Http\Middleware\tokenVerficationMiddleware;
use Illuminate\Support\Facades\Route;


// ------------- PAGE ROUTES ----------//
Route::controller(userController::class)->group(function () {
    Route::get('/login', 'loginPage');
    Route::get('/register', 'registerPage');
    Route::get('/send-otp', 'sendOtpPage');
    Route::get('/verify-otp', 'verifyOtpPage');
    Route::get('/reset-password', 'resetPasswordPage')->middleware(tokenVerficationMiddleware::class);
});

//--- After Authentication
// Dashboard
Route::controller(dashboardController::class)->group(function () {
    Route::get('/dashboard', 'dashboardPage')->middleware(tokenVerficationMiddleware::class);
    Route::get('/user-profile', 'userProfilePage')->middleware(tokenVerficationMiddleware::class);
});
// Category
Route::controller(categoryController::class)->group(function () {
    Route::get('/categories', 'categoriesPage')->middleware(tokenVerficationMiddleware::class);
});

//Product 
Route::controller(productController::class)->group(function () {
    Route::get('/products', 'productsPage')->middleware(tokenVerficationMiddleware::class);
});


//Customer
Route::controller(customerController::class)->group(function () {
    Route::get('/customers', 'customersPage')->middleware(tokenVerficationMiddleware::class);
});


//------------- API ROUTES ------------//
// User
Route::controller(userController::class)->group(function () {
    Route::post('/user-register', 'userRegistration');
    Route::post('/user-login', 'userLogin');
    Route::post('/send-otp', 'sendOTPCode');
    Route::post('/verify-otp', 'verifyOTPCode');
    Route::get('/user-logout', 'userLogOut');

    // Verify Token
    Route::post('/reset-password', 'resetPassword')->middleware(tokenVerficationMiddleware::class);
    Route::get('/user-profile-details', 'userProfile')->middleware(tokenVerficationMiddleware::class);
    Route::post('/user-update', 'userUpdate')->middleware(tokenVerficationMiddleware::class);
});

// Category
Route::controller(categoryController::class)->group(function () {
    Route::post('/create-category', 'createCategory')->middleware(tokenVerficationMiddleware::class);
    Route::post('/update-category', 'updateCategory')->middleware(tokenVerficationMiddleware::class);
    Route::post('/delete-category', 'deleteCategory')->middleware(tokenVerficationMiddleware::class);
    Route::get('/category-list', 'categoryList')->middleware(tokenVerficationMiddleware::class);
});

// Customer
Route::controller(customerController::class)->group(function () {
    Route::post('/create-customer', 'createCustomer')->middleware(tokenVerficationMiddleware::class);
    Route::post('/update-customer', 'updateCustomer')->middleware(tokenVerficationMiddleware::class);
    Route::post('/delete-customer', 'deleteCustomer')->middleware(tokenVerficationMiddleware::class);
    Route::get('/customer-list', 'customerList')->middleware(tokenVerficationMiddleware::class);
    Route::get('/customers/{id}', 'customerById')->middleware(tokenVerficationMiddleware::class);
});

// Product
Route::controller(productController::class)->group(function () {
    Route::post('/create-product', 'createProduct')->middleware(tokenVerficationMiddleware::class);
    Route::post('/update-product', 'updateProduct')->middleware(tokenVerficationMiddleware::class);
    Route::post('/delete-product', 'deleteProduct')->middleware(tokenVerficationMiddleware::class);
    Route::get('/product-list', 'productList')->middleware(tokenVerficationMiddleware::class);
    Route::get('/products/{id}', 'productById')->middleware(tokenVerficationMiddleware::class);
});