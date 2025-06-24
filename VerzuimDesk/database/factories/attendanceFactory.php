<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'present_percentage' => $this->faker->randomFloat(2, 0, 1),
            'excused_absence_percentage' => $this->faker->randomFloat(2, 0, 1),
            'unexcused_absence_percentage' => $this->faker->randomFloat(2, 0, 1),
            'unregistered_percentage' => $this->faker->randomFloat(2, 0, 1),
        ];
    }
}