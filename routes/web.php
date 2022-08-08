<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'home'])->name('home')->middleware(['Local']);
Route::get('/register', [HomeController::class,'register'])->name('register')->middleware(['Local']);


require __DIR__ . '/auth/authAdmin.php';
require __DIR__ . '/auth/authTeacher.php';
require __DIR__ . '/auth/authStudent.php';
require __DIR__ . '/user/admin.php';
require __DIR__ . '/user/teacher.php';
require __DIR__ . '/user/student.php';
