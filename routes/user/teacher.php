<?php

use App\Http\Controllers\Teacher\GroupController;
use App\Http\Controllers\Teacher\CourseController;
use App\Http\Controllers\Teacher\HomeController;
use App\Http\Controllers\Teacher\ImageController;
use App\Http\Controllers\Teacher\MessageController;
use App\Http\Controllers\Teacher\NotificationController;
use App\Http\Controllers\Teacher\SectionController;
use App\Http\Controllers\Teacher\StudentController;
use App\Http\Controllers\Teacher\StudentProfileController;
use App\Http\Controllers\Teacher\TeacherProfileController;
use App\Http\Controllers\Teacher\VideoController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/teacher',
    'as' => 'teacher.',
    'middleware' => ['teacherAuth','Local', 'userverified:teacher','Local'],
], function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::group([
        'prefix' => '/notification',
        'as' => 'notification.',
    ], function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::get('/read/{id}', [NotificationController::class, 'read'])->name('read');
        Route::get('/show', [NotificationController::class, 'show'])->name('show');
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
        Route::get('/{id}', [TeacherProfileController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [TeacherProfileController::class, 'update'])->name('update');
        Route::group([
            'prefix' => '/student',
            'as' => 'student.',
        ], function () {
            Route::get('/{id}/{group_id}', [StudentProfileController::class, 'show'])->name('index');
            Route::get('/remove/{id}/{group_id}', [StudentProfileController::class, 'remove'])->name('remove');
    
        });
    });
    Route::group([
        'prefix' => '/student',
        'as' => 'student.',
    ], function () {
        Route::get('/show/{id}/{group_id}/', [StudentController::class, 'show'])->name('show');
        Route::get('/accept/{id}/{group_id}/{notification_id}', [StudentController::class, 'accept'])->name('accept');
        Route::get('/reject/{id}/{group_id}/{notification_id}', [StudentController::class, 'reject'])->name('reject');
    });
    Route::group([
        'prefix' => '/group',
        'as' => 'group.',
    ], function () {
        Route::get('/', [GroupController::class, 'index'])->name('index');
        Route::get('/member/{id}', [GroupController::class, 'member'])->name('member');
        Route::get('/add', [GroupController::class, 'create'])->name('add');
        Route::post('/save', [GroupController::class, 'store'])->name('save');
        Route::get('/edit/{id}', [GroupController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [GroupController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [GroupController::class, 'destroy'])->name('delete');
    });
    Route::group([
        'prefix' => '/section',
        'as' => 'section.',
    ], function () {
        Route::get('/', [SectionController::class, 'index'])->name('index');
        Route::get('/add', [SectionController::class, 'create'])->name('add');
        Route::post('/save', [SectionController::class, 'store'])->name('save');
        Route::get('/edit/{id}', [SectionController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SectionController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [SectionController::class, 'destroy'])->name('delete');
    });
    Route::group([
        'prefix' => '/course',
        'as' => 'course.',
    ], function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/add', [CourseController::class, 'create'])->name('add');
        Route::post('/save', [CourseController::class, 'store'])->name('save');
        Route::get('/edit/{id}', [CourseController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CourseController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [CourseController::class, 'destroy'])->name('delete');
    });
    Route::group([
        'prefix' => '/image',
        'as' => 'image.',
    ], function () {
        Route::get('/', [ImageController::class, 'index'])->name('index');
        Route::get('/add', [ImageController::class, 'create'])->name('add');
        Route::post('/save', [ImageController::class, 'store'])->name('save');
        Route::get('/edit/{id}', [ImageController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ImageController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [ImageController::class, 'destroy'])->name('delete');
    });
    Route::group([
        'prefix' => '/video',
        'as' => 'video.',
    ], function () {
        Route::get('/', [VideoController::class, 'index'])->name('index');
        Route::get('/add', [VideoController::class, 'create'])->name('add');
        Route::post('/save', [VideoController::class, 'store'])->name('save');
        Route::get('/edit/{id}', [VideoController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [VideoController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [VideoController::class, 'destroy'])->name('delete');
    });
});
