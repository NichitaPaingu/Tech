<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return Student::all();
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string', 'grade_id' => 'required|integer']);

        return Student::create($request->all());
    }

    public function show(Student $student)
    {
        return $student;
    }

    public function update(Request $request, Student $student)
    {
        $request->validate(['name' => 'required|string', 'grade_id' => 'required|integer']);

        $student->update($request->all());
        return $student;
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->noContent();
    }
}
