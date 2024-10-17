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

        // Возвращаем созданный класс в формате JSON с кодом 201 (Created)
        return response()->json($grade, 201);
    }

    public function show(Grade $grade)
    {
        // Возвращаем класс в формате JSON
        return response()->json([
            'grade' => $grade,
            'students' => $grade->students // Предполагая, что есть связь 'students'
        ]);
    }

    public function update(Request $request, Grade $grade)
    {
        $request->validate(['name' => 'required|string']);

        $grade->update($request->all());

        // Возвращаем обновленный класс в формате JSON
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
    // Получаем текущего аутентифицированного пользователя
    $currentUser = Auth::user();

    // Проверяем, совпадает ли ID учителя с ID текущего пользователя
    if ($currentUser->id !== $teacher->id) {
        return response()->json(['error' => 'Доступ запрещен'], 403);
    }

    // Получаем классы, связанные с учителем
    $grades = Grade::whereHas('gradeSubjectTeachers', function ($query) use ($teacher) {
        $query->where('teacher_id', $teacher->id);
    })->with('students')->get();

    return response()->json($grades);
}

}
