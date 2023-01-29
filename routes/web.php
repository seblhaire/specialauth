<?php
use Seblhaire\Specialauth\ForgotPasswordController;
use Seblhaire\Specialauth\ForgotPasswordController;
use Seblhaire\Specialauth\LoginController;
Route::group(['prefix' => config('specialauth.routeprefix'), 'middleware' => 'web'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
    Route::post('login', [LoginController::class, 'login'])->middleware('guest');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
    Route::group(['prefix' => 'password', 'middleware' => 'guest'], function () {

        Route::get('reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    });
});
