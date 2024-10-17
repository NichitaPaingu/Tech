<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        return Teacher::all();
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string', 'email' => 'required|email', 'password' => 'required|string']);

        return Teacher::create($request->all());
    }

    public function show(Teacher $teacher)
    {
        return $teacher;
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate(['name' => 'required|string', 'email' => 'required|email', 'password' => 'nullable|string']);

        $teacher->update($request->all());
        return $teacher;
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return response()->noContent();
    }
}

