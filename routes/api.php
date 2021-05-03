<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/auth', 'namespace' => 'App\Http\Controllers\Auth'], function() {
    Route::post('/register', RegisterController::class);
    Route::post('/login', LoginController::class)->middleware('guest');
    Route::get('/email/verify/{id}', EmailVerificationController::class)->name('verification.verify');
    Route::get('/email/resend', EmailVerificationResendController::class)->name('verification.resend')->middleware(['auth:sanctum']);
    Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');
    Route::get('/me', MeController::class)->middleware(['auth:sanctum', 'verified']);
    Route::post('/forgot-password',ForgotPasswordController::class)->middleware('guest')->name('password.email');
    Route::post('/reset-password', ResetPasswordController::class)->middleware('guest')->name('password.reset');
});

Route::group(['namespace' => 'App\Http\Controllers\Products'], function() {
    Route::get('/products', ProductIndexController::class);
    Route::post('/products', ProductStoreController::class);
});

Route::group(['namespace' => 'App\Http\Controllers\Cart', 'middleware' => 'auth:sanctum'], function() {
    //this route accepts json
    Route::post('/cart', CartStoreController::class);
    Route::put('/cart/{id}', CartUpdateController::class);
    Route::delete('/cart/{id}', CartDestroyController::class);
});
