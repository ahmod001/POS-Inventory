<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\productController;
use App\Http\Controllers\reportController;
use App\Http\Controllers\userController;
use App\Http\Middleware\tokenVerficationMiddleware;

// Dashboard
Route::controller(dashboardController::class)->group(function () {
    Route::get('/total-customer', 'totalCustomer')->middleware(tokenVerficationMiddleware::class);
    Route::get('/total-product', 'totalProduct')->middleware(tokenVerficationMiddleware::class);
    Route::get('/total-category', 'totalCategory')->middleware(tokenVerficationMiddleware::class);
    Route::get('/total-sale', 'totalSale')->middleware(tokenVerficationMiddleware::class);
});

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

// Invoice
Route::controller(invoiceController::class)->group(function () {
    Route::post('/create-invoice', 'createInvoice')->middleware(tokenVerficationMiddleware::class);
    Route::get('/invoice-list', 'invoiceList')->middleware(tokenVerficationMiddleware::class);
    Route::post('/invoice-details', 'invoiceDetails')->middleware(tokenVerficationMiddleware::class);
    Route::post('/delete-invoice', 'deleteInvoice')->middleware(tokenVerficationMiddleware::class);
});

// Report
Route::controller(reportController::class)->group(function () {
    Route::get('/sales-report/{from}/{to}', 'salesReport')->middleware(tokenVerficationMiddleware::class);
});
