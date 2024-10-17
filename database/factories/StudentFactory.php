<?php

namespace Database\Factories;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'grade_id' => Grade::factory(), // Связан с классом
        ];
    }
}
