<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\SubjectController;

Route::apiResource('grades', GradeController::class);
Route::apiResource('students', StudentController::class);
Route::apiResource('teachers', TeacherController::class);
Route::apiResource('subjects', SubjectController::class);

Route::middleware('auth:api')->get('/teacher/grades/{teacher}', [GradeController::class, 'getTeacherGrades']);



