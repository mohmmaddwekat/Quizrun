<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\UserStudentController;
use App\Http\Controllers\Admin\UserTeacherController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/admin',
    'as' => 'admin.',
    'middleware' => ['adminAuth','Local'],
], function () {
    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
    Route::group([
        'prefix' => '/category',
        'as' => 'category.',
    ], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/add', [CategoryController::class, 'create'])->name('add');
        Route::post('/save', [CategoryController::class, 'store'])->name('save');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('delete');
    });
    Route::group([
        'prefix' => '/student',
        'as' => 'student.',
    ], function () {
        Route::get('/', [UserStudentController::class, 'index'])->name('index');
        Route::get('/add', [UserStudentController::class, 'create'])->name('add');
        Route::post('/save', [UserStudentController::class, 'store'])->name('save');
        Route::get('/show/{id}', [UserStudentController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [UserStudentController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [UserStudentController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [UserStudentController::class, 'destroy'])->name('delete');
    });
    Route::group([
        'prefix' => '/teacher',
        'as' => 'teacher.',
    ], function () {
        Route::get('/', [UserTeacherController::class, 'index'])->name('index');
        Route::get('/add', [UserTeacherController::class, 'create'])->name('add');
        Route::post('/save', [UserTeacherController::class, 'store'])->name('save');
        Route::get('/show/{id}', [UserTeacherController::class, 'show'])->name('show');
        Route::post('/approval/{id}', [UserTeacherController::class, 'approval'])->name('approval');
        Route::get('/edit/{id}', [UserTeacherController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [UserTeacherController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [UserTeacherController::class, 'destroy'])->name('delete');
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
        'prefix' => '/admin',
        'as' => 'admins.',
    ], function () {
        Route::get('/', [UserAdminController::class, 'index'])->name('index');
        Route::get('/add', [UserAdminController::class, 'create'])->name('add');
        Route::post('/save', [UserAdminController::class, 'store'])->name('save');
        Route::get('/edit/{id}', [UserAdminController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [UserAdminController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [UserAdminController::class, 'destroy'])->name('delete');
    });
});
