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

Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'action']);
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'action'])->middleware('guest');
Route::get('email/verify/{id}', [App\Http\Controllers\Auth\EmailVerificationController::class, 'action'])->name('verification.verify');
Route::get('email/resend', [App\Http\Controllers\Auth\EmailVerificationResendController::class, 'action'])->name('verification.resend')->middleware(['auth:sanctum']);
Route::post('logout', [App\Http\Controllers\Auth\LogoutController::class, 'action'])->middleware('auth:sanctum');
Route::get('me', [App\Http\Controllers\Auth\MeController::class, 'action'])->middleware(['auth:sanctum', 'verified']);
Route::post('forgot-password',[App\Http\Controllers\Auth\ForgotPasswordController::class, 'action'])->middleware('guest')->name('password.email');
Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'action'])->middleware('guest')->name('password.reset');

