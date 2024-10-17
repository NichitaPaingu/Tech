<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // Имя класса
    ];

    public function students()
    {
        return $this->hasMany(Student::class); // Один класс имеет много учеников
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'grade_subject_teacher'); // Один класс может иметь много учителей через промежуточную таблицу
    }
    public function gradeSubjectTeachers()
    {
        return $this->hasMany(GradeSubjectTeacher::class);
    }
}

