<?php

declare(strict_types=1);

namespace Tests\Browser;

use App\Models\Module;
use App\Models\Task;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DashboardIndexTest extends DuskTestCase
{
    public function test_access_denied_without_user(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('dashboard'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('dashboard/test_access_denied_without_user')
                ->assertRouteIs('login');
        });
    }

    public function test_it_shows_an_empty_dashboard(): void
    {
        $user = User::factory()->createOne();

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('dashboard'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('dashboard/test_it_shows_an_empty_dashboard')
                ->assertSee('Hier findest du eine Übersicht über deinen Lernfortschritt')
                ->assertSee('Deine Stats')
                ->assertSee('0 / 0 Module')
                ->assertSee('Credit Points: 0 / 0')
                ->assertSee('Notendurchschnitt: 0')
                ->assertSee('Deine Module')
                ->assertSee('Deine Termine');
        });
    }

    public function test_it_does_not_show_foreign_modules(): void
    {
        // User does not have any modules and tasks
        $user = User::factory()->createOne();

        $user2 = User::factory()->createOne();
        // The following content is from user 2 who is not logged in
        $module = Module::factory()->createOne(['user_id' => $user2->id]);
        $task = Task::factory()->createOne(['module_id' => $module->id, 'user_id' => $user2->id]);

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('dashboard'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('dashboard/test_it_does_not_show_foreign_modules');

        });
    }

    public function test_it_can_show_a_filled_dashboard(): void
    {
        $user = User::query()->firstWhere('email', '=', 'florian.hellmann@student.wb-hochschule.com');

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('dashboard'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('dashboard/test_it_can_show_a_filled_dashboard')
                ->assertSee('Hier findest du eine Übersicht über deinen Lernfortschritt')
                ->assertSee('Deine Stats')
                ->assertSee('21 / 26 Module')
                ->assertSee('Credit Points: 141 / 177')
                ->assertSee('Notendurchschnitt: 2.0')
                ->assertSee('Deine Module')
                ->assertSee('Projektarbeit')
                ->assertSee('Labor Cybersicherheit')
                ->assertSee('Deine Termine');
        });
    }
}
