<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Exam\ExamComtroller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Result\ResultController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Home\Homeconteoller;
use App\Http\Controllers\Subject\SubjectComtroller;

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


Route::get('/', [Homeconteoller::class, 'index']);
Route::get('/home', [Homeconteoller::class, 'index'])->name('home');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('showLoginForm')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('showRegisterForm')->middleware('guest');
Route::post('register', [RegisterController::class, 'register'])->name('register')->middleware(['guest']); //add 'verified' email verify
Route::get('email/verify',  [Homeconteoller::class, 'verify'])->name('verification.notice');

Route::get('result/{id}', [ResultController::class, 'index'])->name('result.index')->middleware('auth');
Route::get('result/create/{id}', [ResultController::class, 'create'])->name('result.create')->middleware('administrator');
Route::resource('result', ResultController::class, ['except' => ['index' ,'create']])->middleware('auth');

Route::resource('administrator', AdministratorController::class)->middleware(['administrator']);
Route::resource('student', StudentController::class)->middleware('auth');
Route::resource('exam', ExamComtroller::class)->middleware('auth');
Route::resource('subject', SubjectComtroller::class)->middleware('auth');
// Route::redirect('/', 'post');
