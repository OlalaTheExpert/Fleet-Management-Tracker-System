<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'position' => $this->faker->name,
            'pin_code' => $this->faker->randomDigit(10, 15),            
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
