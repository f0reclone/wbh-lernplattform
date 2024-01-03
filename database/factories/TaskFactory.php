<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected array $statusOptions = ['open', 'in_progress', 'done'];

    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement($this->statusOptions),
            'module_id' => $this->faker->randomElement([1,2,3,4,5,6]),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-1 year')->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', '-1 year')->format('Y-m-d H:i:s'),
        ];
    }
}
