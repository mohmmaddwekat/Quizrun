<?php

use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\CustomAuthController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/admin',
    'as' => 'admin.',
    'middleware' => ['Local'],
    'where' => [
        'id' => '[0-9]+',
    ],
], function () {
    Route::group(
        [
            'prefix' => '/auth',
            'as' => 'auth.'
        ],
        function () {
            Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest:admin')
                ->name('register');

            Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest:admin');

            Route::get('/login', [CustomAuthController::class, 'index'])
                ->middleware('guest:admin')
                ->name('login');

            Route::post('/login', [CustomAuthController::class, 'store'])
                ->middleware('guest:admin');

            Route::get('/forgot-password', [PasswordResetController::class, 'create'])
                ->middleware('guest:admin')
                ->name('password.request');

            Route::post('/forgot-password', [PasswordResetController::class, 'store'])
                ->middleware('guest:admin')
                ->name('password.email');

            Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest:admin')
                ->name('password.reset');

            Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest:admin')
                ->name('password.update');

            Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('guest:admin')
                ->name('password.confirm');

            Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('guest:admin');

            Route::get('/logout', [CustomAuthController::class, 'destroy'])
                ->middleware('adminAuth')
                ->name('logout');
        }
    );
});
