<?php

declare(strict_types=1);

namespace Feature\Controllers;

use App\Enums\ModuleStatus;
use App\Models\Module;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModuleControllerStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_redirects_to_login_page_if_no_user_logged_in(): void
    {
        $response = $this->post(route('modules.store'));

        $response->assertRedirect(route('login'));
    }

    public function test_it_can_create_a_module_for_the_current_user(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->postJson(route('modules.store'), [
                'name' => 'Neues Modul',
                'description' => 'Beschreibung des Moduls',
                'status'=> ModuleStatus::Open->value,
                'start_semester' => '1',
                'end_semester' => '2'
            ])->assertRedirect(route('modules.store'));


        $this->assertDatabaseCount('modules', 1);
        $this->assertDatabaseHas('modules', [
            'name' => 'Neues Modul',
            'description' => 'Beschreibung des Moduls',
            'status'=>ModuleStatus::Open->value,
            'start_semester' => '1',
            'end_semester' => '2',
            'user_id' => $user->id
        ]);
    }

    public function test_a_validation_error_is_returned_if_module_data_is_invalid(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->postJson(route('modules.store'), [
                'id'=> 1,
                'name' => null,
                'description' => 'Beschreibung des Moduls',
                'status'=>ModuleStatus::Open->value,
                'start_semester' => '1',
                'end_semester' => '2'
            ])
            ->assertJsonValidationErrors(['name' => ['Name muss ausgefüllt werden.']]);


        $this->assertDatabaseCount('modules', 0);
    }
}
