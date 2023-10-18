<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'website_id' => $this->faker->randomNumber(5, false),
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
        ];
    }
}
