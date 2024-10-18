<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        return view('grades.index');
    }
    public function show()
    {
        return view('grades.show');
    }
}
