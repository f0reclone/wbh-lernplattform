<?php

declare(strict_types=1);

namespace Feature\Controllers;

use App\Enums\TaskStatus;
use App\Models\Module;
use App\Models\Task;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_redirects_to_login_page_if_no_user_logged_in(): void
    {
        $response = $this->put(route('tasks.update', ['task' => 1]));

        $response->assertRedirect(route('login'));
    }

    public function test_it_can_update_a_task_for_the_current_user(): void
    {
        $user = User::factory()->create();
        $module = Module::factory()->createOne(['user_id' => $user->id]);
        $task = Task::factory()->createOne(['title' => 'Aufgabe XY', 'module_id' => $module->id, 'user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->putJson(route('tasks.update', ['task' => $task->id]), [
                'title' => 'Neuer Task',
                'status' => TaskStatus::Done->value
            ])->assertRedirect(route('tasks.index'));


        $this->assertDatabaseCount('tasks', 1);
        $this->assertDatabaseHas('tasks', [
            'title' => 'Neuer Task',
            'module_id' => $module->id,
            'user_id' => $user->id,
            'status' => TaskStatus::Done->value
        ]);
    }

    public function test_it_can_change_just_the_status_for_the_kan_ban_board(): void
    {
        $this->markTestSkipped();
        $user = User::factory()->create();
        $module = Module::factory()->createOne(['user_id' => $user->id]);
        $task = Task::factory()->createOne(['title' => 'Aufgabe XY', 'module_id' => $module->id, 'user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->putJson(route('tasks.update', ['task' => $task->id]), [
                'status' => TaskStatus::InProgress->value,

            ])->assertOk();


        $this->assertDatabaseCount('tasks', 1);
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => TaskStatus::InProgress->value
        ]);
    }

    public function test_it_is_forbidden_to_update_tasks_from_other_users(): void
    {
        $user = User::factory()->create();
        $module = Module::factory()->createOne(['user_id' => $user->id]);
        $task = Task::factory()->createOne(['title' => 'Aufgabe XY', 'module_id' => $module->id, 'user_id' => $user->id]);

        $newUser = User::factory()->createOne();
        $response = $this
            ->actingAs($newUser)
            ->putJson(route('tasks.update', ['task' => $task->id]), [
                'title' => 'Neuer Task',
                'status' => TaskStatus::Done->value
            ])->assertForbidden();
    }

    public function test_a_validation_error_is_returned_if_task_data_is_invalid(): void
    {
        $user = User::factory()->create();
        $module = Module::factory()->createOne(['user_id' => $user->id]);
        $task = Task::factory()->createOne(['title' => 'Aufgabe XY', 'module_id' => $module->id, 'user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->putJson(route('tasks.update', ['task' => $task->id]), [
                'status' => 'random'
            ])
            ->assertJsonValidationErrors(['status' => ['Der ausgewählte Wert ist ungültig.']]);


        $this->assertDatabaseCount('tasks', 1);
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'status' => TaskStatus::Open->value]);
    }
}
