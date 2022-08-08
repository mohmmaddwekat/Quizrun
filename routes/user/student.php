<?php

use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\Student\GroupController;
use App\Http\Controllers\Student\HomeController;
use App\Http\Controllers\Student\MessageController;
use App\Http\Controllers\Student\NotificationController;
use App\Http\Controllers\Student\SearchController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\TeacherProfileController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/student',
    'as' => 'student.',
    'middleware' => ['studentAuth','Local','userverified:student'],
], function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::group([
        'prefix' => '/search',
        'as' => 'search.',
    ], function () {
        Route::get('/', [SearchController::class, 'index'])->name('index');
        Route::post('/queries', [SearchController::class, 'show'])->name('query');
    });
    Route::group([
        'prefix' => '/message',
        'as' => 'message.',
    ], function () {
        Route::get('index/{id}', [MessageController::class, 'index'])->name('index');
        Route::get('/add/{id}', [MessageController::class, 'create'])->name('add');
        Route::get('/save/{id}/{messages}', [MessageController::class, 'store'])->name('save');
    });
    Route::group([
        'prefix' => '/profile',
        'as' => 'profile.',
    ], function () {
        Route::get('/{id}', [StudentProfileController::class, 'show'])->name('index');
        Route::post('/update/{id}', [StudentProfileController::class, 'update'])->name('update');
        Route::group([
            'prefix' => '/teacher',
            'as' => 'teacher.',
        ], function () {
            Route::get('/{id}', [TeacherProfileController::class, 'show'])->name('index');
        });
    });
    Route::group([
        'prefix' => '/group',
        'as' => 'group.',
    ], function () {
        Route::get('/index/{id}', [GroupController::class, 'index'])->name('index');
        Route::get('/show/{id}', [GroupController::class, 'show'])->name('show');
        Route::get('/myGroup/{id}', [GroupController::class, 'myGroup'])->name('myGroup');
        Route::post('/join/{id}', [GroupController::class, 'join'])->name('join');
        Route::get('/member/{id}', [GroupController::class, 'member'])->name('member');
        Route::get('/category/{id}', [GroupController::class, 'category'])->name('category');
    });
    Route::group([
        'prefix' => '/notification',
        'as' => 'notification.',
    ], function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::get('/read/{id}', [NotificationController::class, 'read'])->name('read');
        Route::get('/show', [NotificationController::class, 'show'])->name('show');
    });
    Route::group([
        'prefix' => '/course',
        'as' => 'course.',
    ], function () {
        Route::get('/index/{id}', [CourseController::class, 'index'])->name('index');
    });
});
