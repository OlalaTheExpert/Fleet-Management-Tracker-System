<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'position' => 'Full-Stack Developer',
            'vehicle_id'=>'1',
            'mission'=>$this->faker->name(12),
            'email' => $this->faker->unique()->safeEmail(),
            'pin_code' => $this->faker->randomDigit(10, 15),
            // 'pin_code' => Str::random(10),
            'permissions'=>'1',
            // tinyInteger('permissions')->default('1'),
            'email_verified_at' => now(),
            'remember_token' => $this->faker->randomDigit(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
