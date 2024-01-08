<?php

namespace Tests\Browser;

use App\Models\Module;
use App\Models\Task;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BoardTest extends DuskTestCase
{
    public function test_access_denied_without_user(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('board'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('board/test_access_denied_without_user')
                ->assertRouteIs('login');
        });
    }

    public function test_it_shows_an_empty_board(): void
    {
        $user = User::factory()->createOne();

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('board'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('board/test_it_shows_an_empty_kanBan_board')
                ->assertSee('Hier findest du deine Aufgaben.')
                ->assertSee('Offen')
                ->assertSee('In Bearbeitung')
                ->assertSee('Erledigt');
        });
    }

    public function test_it_can_show_a_task_on_the_board(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $module = Module::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->create([
            'user_id' => $user->id,
            'module_id' => $module->id,
            'status' => 'in_progress',
        ]);

        $this->browse(function (Browser $browser) use ($user, $task, $module) {
            $browser->loginAs($user)
                ->visit(route('board'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('board/test_it_can_show_a_task_on_the_board')
                ->assertSee($task->title);
        });
    }

    public function test_it_does_not_show_foreign_tasks(): void
    {
        // User does not have any modules and tasks
        $user = User::factory()->create();

        $user2 = User::factory()->create();
        // The following content is from user 2 who is not logged in
        $module = Module::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->create([
            'user_id' => $user2->id,
            'module_id' => $module->id,
            'status' => 'in_progress',
        ]);

        $this->browse(function (Browser $browser) use($user, $task) {
            $browser->loginAs($user)
                ->visit(route('board'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('board/test_it_does_not_show_foreign_tasks')
                ->assertDontSee($task->title);


        });
    }

    public function test_it_can_shows_tasks_with_status_open(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $module = Module::factory()->create(['user_id' => $user->id]);

        // Erstelle einen Task im Status "Offen"
        $taskOpen = Task::factory()->create([
            'user_id' => $user->id,
            'module_id' => $module->id,
            'status' => 'open',
        ]);

        $this->browse(function (Browser $browser) use ($user, $taskOpen) {
            $browser->loginAs($user)
                ->visit(route('board'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('board/test_it_can_shows_tasks_with_status_open')
                ->assertSee($taskOpen->title);

        });
    }
    public function test_it_can_shows_tasks_with_status_in_progress(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $module = Module::factory()->create(['user_id' => $user->id]);

        // Erstelle einen Task im Status "Offen"
        $taskInProgress = Task::factory()->create([
            'user_id' => $user->id,
            'module_id' => $module->id,
            'status' => 'in_progress',
        ]);

        $this->browse(function (Browser $browser) use ($user, $taskInProgress) {
            $browser->loginAs($user)
                ->visit(route('board'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('board/test_it_can_shows_tasks_with_status_in_progress')
                ->assertSee($taskInProgress->title);

        });
    }
    public function test_it_can_shows_tasks_with_status_done(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $module = Module::factory()->create(['user_id' => $user->id]);

        // Erstelle einen Task im Status "Offen"
        $taskDone = Task::factory()->create([
            'user_id' => $user->id,
            'module_id' => $module->id,
            'status' => 'done',
        ]);

        $this->browse(function (Browser $browser) use ($user, $taskDone) {
            $browser->loginAs($user)
                ->visit(route('board'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('board/test_it_can_shows_tasks_with_status_done')
                ->assertSee($taskDone->title);

        });
    }

    public function test_it_has_a_filter_for_semesters(): void
    {
        $user = User::factory()->createOne();

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('board'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('board/test_it_has_a_filter_for_semesters')
                ->assertSee('Hier findest du deine Aufgaben.')
                ->assertSee('Semester');

        });
    }

    public function test_it_has_a_button_to_create_new_tasks(): void
    {
        $user = User::factory()->createOne();

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('board'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('board/test_it_has_a_button_to_create_new_tasks')
                ->assertSee('Hier findest du deine Aufgaben.')
                ->assertSee('Aufgabe erstellen');

        });
    }
}
