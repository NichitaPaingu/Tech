<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password', // Для пароля
        'role', // 'director' или 'teacher'
        'subject_id',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    // Связь с классами
    public function grades()
    {
        return $this->hasMany(GradeSubjectTeacher::class); // Один учитель ведет много классов
    }
    // Связь с предметами
    public function subject()
    {
        return $this->belongsTo(Subject::class); // Связь с предметом
    }

    // Проверка роли
    public function isDirector()
    {
        return $this->role === 'director';
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }
}
