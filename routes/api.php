<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


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
