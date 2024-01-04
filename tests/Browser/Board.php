<?php

namespace Tests\Browser;

use App\Models\Module;
use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class Board extends TestCase
{

    /**
     * A basic feature test example.
     */
    public function test_todo_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/board');

        $response->assertStatus(200);
    }

    public function test_example(): void
    {
        $user = User::factory()->create();
        $module = Module::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->create([
            'user_id' => $user->id,
            'module_id' => $module->id,
            'status' => 'in_progress',
            //'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']),
        ]);

        $this->actingAs($user);

        $response = $this->get('/board');

        $response->assertStatus(200);
        $response->assertSeeText($task->title);
    }
}
