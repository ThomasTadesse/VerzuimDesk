<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition()
    {
        return [
            'student_number' => $this->faker->unique()->numberBetween(300000, 400000),
            'name' => $this->faker->lastName . ', ' . $this->faker->firstName,
            'age_group' => $this->faker->randomElement(['<18', '18-22', '23+']),
        ];
    }
}
