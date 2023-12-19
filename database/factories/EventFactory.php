<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => 'university_external',
            'title' => $this->faker->name,
            'is_editable' => false,
            'is_full_day' => false,
            'start' => Carbon::now(),
            'end' => Carbon::now()->addHours(2)
        ];
    }
}
