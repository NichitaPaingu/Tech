<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Student;
use App\Models\GradeSubjectTeacher;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Создаем предметы
        $subjects = Subject::factory()->count(4)->create();

        // Создаем директора
        Teacher::factory()->create([
            'name' => 'Паингу Никита',
            'email' => 'director@example.com',
            'password' => bcrypt('password'),
            'role' => 'director',
            'subject_id' => null, // Убедитесь, что в миграции это поле может быть null
        ]);

        // Создаем учителей и назначаем им по одному предмету
        $teachers = Teacher::factory()->count(10)->create()->each(function ($teacher) use ($subjects) {
            // Назначаем случайный предмет
            $subject = $subjects->random();
            $teacher->subject()->associate($subject)->save(); // Устанавливаем предмет для учителя
        });

        // Создаем классы
        $grades = Grade::factory()->count(12)->create();

        // Привязываем учителей к классам и предметам
        foreach ($grades as $grade) {
            foreach ($subjects as $subject) {
                // Собираем всех учителей, у которых менее 6 классов по данному предмету
                $freeTeachers = $teachers->filter(function ($teacher) use ($subject) {
                    return $teacher->subject_id === $subject->id && $teacher->grades()->count() < 5;
                });

                // Если есть подходящие учителя, выбираем случайного
                if ($freeTeachers->isNotEmpty()) {
                    $teacher = $freeTeachers->random(); // Случайный выбор учителя

                    // Создаем связь между классом, предметом и учителем
                    GradeSubjectTeacher::factory()->create([
                        'grade_id' => $grade->id,
                        'subject_id' => $subject->id,
                        'teacher_id' => $teacher->id, // Используем выбранного учителя
                    ]);
                }
            }

            // Создаем студентов для каждого класса
            Student::factory()->count(30)->create([
                'grade_id' => $grade->id, // Привязываем студентов к классу
            ]);
        }
    }
}
