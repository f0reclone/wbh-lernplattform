<?php

declare(strict_types=1);

namespace Feature\Controllers;

use App\Enums\ModuleStatus;
use App\Models\Module;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_redirects_to_login_page_if_no_user_logged_in(): void
    {
        $response = $this->put(route('modules.update'));

        $response->assertRedirect(route('login'));
    }

    public function test_it_can_update_a_task_for_the_current_user(): void
    {
        $user = User::factory()->create();
        $module = Module::factory()->createOne(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->putJson(route('modules.update'), [
                'name' => 'Modul bearbeiten',
                'description' => 'Beschreibung des Moduls',
                'Status'=> ModuleStatus::Open->value,
                'start_semester' => '1',
                'end_semester' => '2'
            ])->assertRedirect(route('modules.index'));


        $this->assertDatabaseCount('modules', 1);
        $this->assertDatabaseHas('modules', [
            'module_id' => $module->id,
            'name' => 'Modul bearbeiten',
            'description' => 'Beschreibung des Moduls',
            'Status'=> ModuleStatus::Open->value,
            'start_semester' => '1',
            'end_semester' => '2',
            'user_id' => $user->id,
        ]);
    }

    public function test_it_can_change_just_the_status_for_the_module(): void
    {
        $user = User::factory()->create();
        $module = Module::factory()->createOne(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->putJson(route('modules.update'), [
                'name' => 'Modul bearbeiten',
                'description' => 'Beschreibung des Moduls',
                'Status'=> ModuleStatus::Open->value,
                'start_semester' => '1',
                'end_semester' => '2'
            ])->assertRedirect(route('modules.index'));

        $response = $this
            ->actingAs($user)
            ->putJson(route('modules.update'), [
                'status' => ModuleStatus::InProgress->value,

            ])->assertOk();


        $this->assertDatabaseCount('modules', 1);
        $this->assertDatabaseHas('modules', [
            'id' => $module->id,
            'status' => ModuleStatus::InProgress->value
        ]);
    }

    public function test_it_is_forbidden_to_update_modules_from_other_users(): void
    {
        $user = User::factory()->create();
        $module = Module::factory()->createOne(['user_id' => $user->id]);


        $newUser = User::factory()->createOne();
        $response = $this
            ->actingAs($newUser)
            ->putJson(route('modules.update'), [
                'name' => 'Modul bearbeiten',
                'description' => 'Beschreibung des Moduls',
                'Status'=> ModuleStatus::Open->value,
                'start_semester' => '1',
                'end_semester' => '2'
            ])->assertForbidden();
    }

    public function test_a_validation_error_is_returned_if_module_data_is_invalid(): void
    {
        $user = User::factory()->create();
        $module = Module::factory()->createOne(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->putJson(route('modules.update'), [
                'status' => 'random'
            ])
            ->assertJsonValidationErrors(['status' => ['Der ausgewählte Wert ist ungültig.']]);


        $this->assertDatabaseCount('modules', 1);
        $this->assertDatabaseHas('modules', [
            'id' => $module->id,
        ]);
    }
}
