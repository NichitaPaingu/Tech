<?php

namespace Database\Factories;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    private static $grade = 0;
    protected $model = Grade::class;

    public function definition()
    {
        self::$grade++;
        return [
            'name' => self::$grade . ' A ',
        ];
    }
}
