<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => $this->faker->name(12), 
            'model' => $this->faker->lastName(12), 
            'color' => $this->faker->colorName(),
            'plateno' => $this->faker->bothify('?###??##'),                                  
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
