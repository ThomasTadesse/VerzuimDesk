<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    public function definition()
    {
        return [
            'code' => 'IO-SD-' . $this->faker->numberBetween(2000, 2500) . $this->faker->randomElement(['A', 'B']),
            'name' => 'Software Development ' . $this->faker->year,
        ];
    }
}