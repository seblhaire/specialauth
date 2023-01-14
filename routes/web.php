<?php
use Seblhaire\Specialauth\AuthController;
Route::group(['prefix' => config('specialauth.routeprefix')], function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
    Route::post('login', [AuthController::class, 'store'])->middleware('guest');
    Route::post('logout', [AuthController::class, 'destroy'])->name('logout')->middleware('auth');
    Route::group(['prefix' => 'password', 'middleware' => 'guest'], function () {

        Route::get('reset', [AuthController::class, 'resetPasswordPage'])->name('password.request');
        Route::post('email', [AuthController::class, 'sendResetPasswordLink'])->name('password.email');
        Route::get('/reset/{token}', [AuthController::class, 'resetPasswordFormPage'])->name('password.reset');
        Route::post('/reset', [AuthController::class, 'resetPassword'])->name('password.update');
    });
});
?>
