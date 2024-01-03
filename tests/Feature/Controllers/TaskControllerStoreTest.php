<?php

declare(strict_types=1);

namespace Feature\Controllers;

use App\Models\Module;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_redirects_to_login_page_if_no_user_logged_in(): void
    {
        $response = $this->post(route('tasks.store'));

        $response->assertRedirect(route('login'));
    }

    public function test_it_can_create_a_task_for_the_current_user(): void
    {
        $user = User::factory()->create();
        $module = Module::factory()->createOne(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->postJson(route('tasks.store'), [
                'title' => 'Neuer Task',
                'description' => 'Beschreibung 123',
                'moduleId' => $module->id,
            ])->assertRedirect(route('tasks.index'));


        $this->assertDatabaseCount('tasks', 1);
        $this->assertDatabaseHas('tasks', [
            'title' => 'Neuer Task',
            'description' => 'Beschreibung 123',
            'module_id' => $module->id,
            'user_id' => $user->id
        ]);
    }

    public function test_a_validation_error_is_returned_if_task_data_is_invalid(): void
    {
        $user = User::factory()->create();
        $module = Module::factory()->createOne(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->postJson(route('tasks.store'), [
                'title' => null,
                'description' => 'Beschreibung 123',
                'moduleId' => $module->id,
            ])
            ->assertJsonValidationErrors(['title' => ['Titel muss ausgefüllt werden.']]);


        $this->assertDatabaseCount('tasks', 0);
    }
}
