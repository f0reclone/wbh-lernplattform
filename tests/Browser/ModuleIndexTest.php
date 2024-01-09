<?php

declare(strict_types=1);

namespace Tests\Browser;

use App\Models\Module;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ModuleIndexTest extends DuskTestCase
{

    public function test_access_denied_without_user(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('modules'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('modules/test_access_denied_without_user')
                ->assertRouteIs('login');
        });
    }

    public function test_it_shows_an_empty_module_overview(): void
    {
        $user = User::factory()->createOne();

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('modules'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('modules/test_it_shows_an_empty_modules_overview')
                ->assertSee('Module')
                ->assertSee('Module hinzufügen')
                ->assertSee('Status')
                ->assertSee('Semester')
                ->assertSee('Sortieren nach')
                ->assertSee('Es sind keine Module verfügbar. Erstelle doch welche!');
        });
    }

    public function test_it_does_not_show_foreign_modules(): void
    {
        // User does not have any modules
        $user = User::factory()->createOne();

        $user2 = User::factory()->createOne();
        // The following content is from user 2 who is not logged in
        $module = Module::factory()->createOne(['user_id' => $user2->id]);

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('modules'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('modules/test_it_does_not_show_foreign_modules')
                ->assertSee('Module')
                ->assertSee('Module hinzufügen')
                ->assertSee('Status')
                ->assertSee('Semester')
                ->assertSee('Sortieren nach')
                ->assertSee('Es sind keine Module verfügbar. Erstelle doch welche!');

        });
    }

    public function test_it_shows_own_modules(): void
    {
        $user = User::factory()->createOne();

        $module = Module::factory()->createOne(['user_id' => $user->id]);

        $this->browse(function (Browser $browser) use($user, $module) {
            $browser->loginAs($user)
                ->visit(route('modules'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('tasks/test_it_shows_own_modules')
                ->assertSee('Module')
                ->assertSee('Module hinzufügen')
                ->assertSee('Status')
                ->assertSee('Semester')
                ->assertSee('Sortieren nach')
                ->assertSee($module->name);

        });
    }
}
