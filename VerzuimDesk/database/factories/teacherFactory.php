<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    public function definition()
    {
        $lastName = $this->faker->lastName;
        $firstName = $this->faker->firstName;
        
        return [
            'name' => $lastName . ',' . $firstName[0] . '.',
            'code' => strtoupper(substr($lastName, 0, 3)) . '.' . $firstName[0] . '.',
        ];
    }
}