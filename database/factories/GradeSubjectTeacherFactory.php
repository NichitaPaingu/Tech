<?php

namespace Database\Factories;

use App\Models\GradeSubjectTeacher;
use App\Models\Grade;
use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradeSubjectTeacherFactory extends Factory
{
    protected $model = GradeSubjectTeacher::class;

    public function definition()
    {
        return [
            'grade_id' => Grade::factory(),
            'subject_id' => Subject::factory(),
            'teacher_id' => Teacher::factory(),
        ];
    }
}
