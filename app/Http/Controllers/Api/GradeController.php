<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function index()
    {
        return response()->json(Grade::all());
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);

        $grade = Grade::create($request->all());

        return response()->json($grade, 201);
    }

    public function show(Grade $grade)
    {
        return response()->json([
            'grade' => $grade,
            'students' => $grade->students
        ]);
    }

    public function update(Request $request, Grade $grade)
    {
        $request->validate(['name' => 'required|string']);

        $grade->update($request->all());
        return response()->json($grade);
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();

        // Возвращаем 204 No Content
        return response()->noContent();
    }
    public function getTeacherGrades(Teacher $teacher)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return response()->json(['error' => 'Пользователь не аутентифицирован'], 401);
        }

        if ($currentUser->id !== $teacher->id) {
            return redirect('/dashboard')->with('error', 'Доступ запрещен');
        }

        $grades = Grade::whereHas('gradeSubjectTeachers', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })->with('students')->get();

        return response()->json($grades);
    }
}
