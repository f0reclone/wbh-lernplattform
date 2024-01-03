<?php

namespace Database\Factories;

use App\Enums\ModuleStatus;
use Carbon\Carbon;
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

    protected array $statusOptions = ['open', 'in_progress', 'waiting_for_result','done_with_grade', 'done_without_grade'];

    protected int $minSemester = 1;
    protected int $maxSemester = 10;

    public function definition(): array
    {

        $startSemester = $this->faker->numberBetween($this->minSemester, $this->maxSemester);
        $endSemester = $this->faker->numberBetween($startSemester, $this->maxSemester);

        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(ModuleStatus::values()),
            'start_semester' => $startSemester,
            'end_semester' => $endSemester,
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-1 year')->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', '-1 year')->format('Y-m-d H:i:s'),

        ];
    }
}
