<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\SubjectController;


Route::middleware(['auth', 'api', 'web'])->group(function () {
    Route::apiResource('grades', GradeController::class);
    Route::apiResource('students', StudentController::class);
    Route::apiResource('teachers', TeacherController::class);
    Route::apiResource('subjects', SubjectController::class);

    Route::get('/teacher/grades/{teacher}', [GradeController::class, 'getTeacherGrades']);
    Route::get('/grades/{grade}/students', [StudentController::class, 'getStudentsByGrade']);
});
