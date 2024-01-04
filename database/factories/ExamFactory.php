<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\Module;
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
            'grade' => $this->faker->randomElement(Exam::AVAILABLE_GRADES),
            'credit_points' => $this->faker->numberBetween(2,8),
            'semester' => $this->faker->numberBetween(1,6),
            'module_id' => Module::query()->first() ?? Module::factory()->createOne()->id,
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-1 year')->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', '-1 year')->format('Y-m-d H:i:s'),
        ];
    }
}
