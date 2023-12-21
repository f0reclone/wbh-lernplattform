<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startSemester = $this->faker->numberBetween(1, 6);
        return [
            'name' => $this->faker->name,
            'status' => 'open',
            'start_semester' => $startSemester,
            'end_semester' => $startSemester + $this->faker->numberBetween(0, 1),
        ];
    }
}
