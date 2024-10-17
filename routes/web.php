<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;

// Главная страница с формой входа
Route::get('/', function () {
    return view('home'); // Измените на представление с формой входа
})->name('home');

// Страницы входа
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Панель управления (только для аутентифицированных пользователей)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');  // Страница панели управления
    })->name('dashboard');

    // Страница с классами для учителей
    Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
    Route::get('/grades/{grade}', [GradeController::class, 'show'])->name('grades.show');
});
Route::get('/grades/{grade}', [GradeController::class, 'show'])->name('grades.show');
