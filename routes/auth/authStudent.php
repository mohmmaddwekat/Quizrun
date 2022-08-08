<?php

use App\Http\Controllers\Student\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Student\Auth\CustomAuthController;
use App\Http\Controllers\Student\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Student\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Student\Auth\NewPasswordController;
use App\Http\Controllers\Student\Auth\PasswordResetController;
use App\Http\Controllers\Student\Auth\RegisteredUserController;
use App\Http\Controllers\Student\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/student',
    'as' => 'student.',
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
                ->middleware('guest:student')
                ->name('register');

            Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest:student');

            // Google login
            Route::get('/login/google', [CustomAuthController::class, 'redirectToGoogle'])->name('login.google');

            Route::get('/login/google/callback', [CustomAuthController::class, 'handleGoogleCallback']);

            Route::get('/login', [CustomAuthController::class, 'index'])
                ->middleware('guest:student')
                ->name('login');

            Route::post('/login', [CustomAuthController::class, 'store'])
                ->middleware('guest:student');

            Route::get('/forgot-password', [PasswordResetController::class, 'create'])
                ->middleware('guest:student')
                ->name('password.request');

            Route::post('/forgot-password', [PasswordResetController::class, 'store'])
                ->middleware('guest:student')
                ->name('password.email');

            Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest:student')
                ->name('password.reset');

            Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest:student')
                ->name('password.update');

            Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('studentAuth')
                ->name('verification.notice');

            Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['studentAuth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

            Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['studentAuth', 'throttle:6,1'])
                ->name('verification.send');

            Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('guest:student')
                ->name('password.confirm');

            Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('guest:student');

            Route::get('/logout', [CustomAuthController::class, 'destroy'])
                ->middleware('studentAuth')
                ->name('logout');
        }
    );
});
