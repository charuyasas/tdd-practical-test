<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'website_id'=>$this->faker->randomNumber(5, false),
            'user_id'=>$this->faker->randomNumber(5, false),
        ];
    }
}
