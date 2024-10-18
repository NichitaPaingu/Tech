<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');
    Route::get('/grades',[GradeController::class,'index']);
    Route::get('/grades/{grade}',[GradeController::class,'show']);

    Route::get('/teachers',[TeacherController::class,'index']);
});

