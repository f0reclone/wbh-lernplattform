<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
use App\Models\Module;
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
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(TaskStatus::values()),
            'module_id' => Module::query()->first() ?? Module::factory()->createOne()->id,
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-1 year')->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', '-1 year')->format('Y-m-d H:i:s'),
        ];
    }
}
