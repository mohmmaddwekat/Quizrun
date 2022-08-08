<?php

use App\Http\Controllers\Teacher\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Teacher\Auth\CustomAuthController;
use App\Http\Controllers\Teacher\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Teacher\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Teacher\Auth\NewPasswordController;
use App\Http\Controllers\Teacher\Auth\PasswordResetController;
use App\Http\Controllers\Teacher\Auth\RegisteredUserController;
use App\Http\Controllers\Teacher\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/teacher',
    'as' => 'teacher.',
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
                ->middleware('guest:teacher')
                ->name('register');

            Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest:teacher');

            Route::get('/login', [CustomAuthController::class, 'index'])
                ->middleware('guest:teacher')
                ->name('login');

            Route::post('/login', [CustomAuthController::class, 'store'])
                ->middleware('guest:teacher');

            Route::get('/forgot-password', [PasswordResetController::class, 'create'])
                ->middleware('guest:teacher')
                ->name('password.request');

            Route::post('/forgot-password', [PasswordResetController::class, 'store'])
                ->middleware('guest:teacher')
                ->name('password.email');

            Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest:teacher')
                ->name('password.reset');

            Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest:teacher')
                ->name('password.update');

            Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('teacherAuth')
                ->name('verification.notice');

            Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['teacherAuth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

            Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['teacherAuth', 'throttle:6,1'])
                ->name('verification.send');

            Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('guest:student')
                ->name('password.confirm');

            Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('guest:student');

            Route::get('/logout', [CustomAuthController::class, 'destroy'])
                ->middleware('teacherAuth')
                ->name('logout');
        }
    );
});
