<?php
use Seblhaire\Specialauth\AuthController;
use Seblhaire\Specialauth\LoginController;
Route::group(['prefix' => config('specialauth.routeprefix'), 'middleware' => 'web'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
    Route::post('login', [LoginController::class, 'login'])->middleware('guest');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
    Route::group(['prefix' => 'password', 'middleware' => 'guest'], function () {

        Route::get('reset', [AuthController::class, 'resetPasswordPage'])->name('password.request');
        Route::post('email', [AuthController::class, 'sendResetPasswordLink'])->name('password.email');
        Route::get('/reset/{token}', [AuthController::class, 'resetPasswordFormPage'])->name('password.reset');
        Route::post('/reset', [AuthController::class, 'resetPassword'])->name('password.update');
    });
});
