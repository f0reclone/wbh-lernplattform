<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers;

use App\Models\Module;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BoardControllerIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_todo_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('board'));

        $response->assertStatus(200);
    }
}
