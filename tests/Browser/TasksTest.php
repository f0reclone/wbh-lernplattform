<?php

declare(strict_types=1);

namespace Tests\Browser;

use App\Models\Module;
use App\Models\Task;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TasksTest extends DuskTestCase
{

    public function test_access_denied_without_user(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('tasks.index'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('tasks/test_access_denied_without_user')
                ->assertRouteIs('login');
        });
    }

    public function test_it_shows_an_empty_task_overview(): void
    {
        $user = User::factory()->createOne();

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('tasks.index'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('tasks/test_it_shows_an_empty_task_overview')
                ->assertSee('Aufgaben')
                ->assertSee('AUFGABE ERSTELLEN')
                ->assertSee('Es sind keine Aufgaben verfügbar. Erstelle doch welche!');
        });
    }

    public function test_it_does_not_show_foreign_tasks(): void
    {
        // User does not have any modules and tasks
        $user = User::factory()->createOne();

        $user2 = User::factory()->createOne();
        // The following content is from user 2 who is not logged in
        $module = Module::factory()->createOne(['user_id' => $user2->id]);
        $task = Task::factory()->createOne(['module_id' => $module->id, 'user_id' => $user2->id]);

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('tasks.index'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('tasks/test_it_does_not_show_foreign_tasks')
                ->assertSee('Aufgaben')
                ->assertSee('AUFGABE ERSTELLEN')
                ->assertSee('Es sind keine Aufgaben verfügbar. Erstelle doch welche!');

        });
    }

    public function test_it_shows_own_tasks(): void
    {
        $user = User::factory()->createOne();

        $module = Module::factory()->createOne(['user_id' => $user->id]);
        $task = Task::factory()->createOne(['module_id' => $module->id, 'user_id' => $user->id]);

        $this->browse(function (Browser $browser) use($user, $task, $module) {
            $browser->loginAs($user)
                ->visit(route('tasks.index'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('tasks/test_it_shows_own_tasks')
                ->assertSee('Aufgaben')
                ->assertSee('AUFGABE ERSTELLEN')
                ->assertDontSee('Es sind keine Aufgaben verfügbar. Erstelle doch welche!')
                ->assertSee($task->title)
                ->assertSee($module->name);

        });
    }
}
