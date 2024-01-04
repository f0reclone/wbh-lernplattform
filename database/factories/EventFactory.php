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
        $examValue = ['university_external', 'exam'];
        $locationValue = ['online', 'Prüfungsstandort'];

        return [
            'key' => $this->faker->randomElement($examValue),
            'title' => $this->faker->name,
            'description' => $this->faker->sentence,
            'location' => $this->faker->randomElement($locationValue),
            'related_id' => null,
            'related_type' => null,
            'is_editable' => false,
            'start' => Carbon::now(),
            'end' => Carbon::now()->addHours(2),
            'is_full_day' => false,
            'external_id' => false,
            'created_at' => $this->faker->dateTimeBetween('-2 year', '-1 year')->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeBetween('-2 year', '-1 year')->format('Y-m-d H:i:s'),

        ];
    }
}
