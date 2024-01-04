<?php

namespace Tests\Browser;

use App\Models\Module;
use App\Models\Task;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BoardTest extends DuskTestCase
{
    public function test_it_can_show_a_task_on_the_board(): void
    {
        $user = User::factory()->create();
        $module = Module::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->create([
            'user_id' => $user->id,
            'module_id' => $module->id,
            'status' => 'in_progress',
        ]);

        $this->actingAs($user);

        $response = $this->get('/board');

        $response->assertStatus(200);
        $response->assertSeeText($task->title);


        $this->browse(function (Browser $browser) use ($user, $task, $module) {
            $browser->loginAs($user)
                ->visit(route('board'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('board/test_it_can_show_a_task_on_the_board')
                ->assertSee($task->title);
        });
    }
}
