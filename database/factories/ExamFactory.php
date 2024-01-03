<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->word,
            'grade' => $this->faker->numberBetween(10,50),
            'credit_points' => $this->faker->numberBetween(2,8),
            'semester' => $this->faker->numberBetween(1,6),
            'module_id' => $this->faker->numberBetween(1,15),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-1 year')->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', '-1 year')->format('Y-m-d H:i:s'),
        ];
    }
}
