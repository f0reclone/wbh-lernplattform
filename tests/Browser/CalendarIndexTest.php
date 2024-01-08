<?php

declare(strict_types=1);

namespace Tests\Browser;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CalendarIndexTest extends DuskTestCase
{
    public function test_it_redirects_to_login_without_user(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('calendar'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('calendar/test_it_redirects_to_login_without_user')
                ->assertRouteIs('login');
        });
    }

    public function test_it_shows_an_empty_calendar(): void
    {
        $user = User::factory()->createOne();

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('calendar'))
                ->waitUntilMissing('#nprogress', 2)
                ->screenshot('calendar/test_it_shows_an_empty_calendar')
                ->assertSee('Hier findest deine aktuellen Termine.')
                ->assertSee('Woche')
                ->assertSee('01 Uhr');
        });
    }

    public function test_it_shows_a_current_event(): void
    {
        // User does not have any modules and tasks
        $user = User::factory()->createOne();
        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: B-CSI02XX',
                'description' => 'B-Prüfung/ Laborabschlussprüfung Cyber-Sicherheit',
                'location' => 'online',
                'related_id' => null,
                'related_type' => null,
                'is_editable' => true,
                'start' => Carbon::now()->startOfHour(),
                'end' => Carbon::now()->addHours(2)->startOfHour(),
                'is_full_day' => false,
                'external_id' => null,
                'created_at' => '2023-11-16 12:00:00',
                'updated_at' => '2023-11-16 12:00:00',
            ],
        );

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('calendar'))
                ->waitUntilMissing('#nprogress', 2)
                ->scrollIntoView('.current-time-line')
                ->assertSee('Abgabetermin: B-CSI02XX')
                ->screenshot('calendar/test_it_shows_a_current_event');

        });
    }
    public function test_it_shows_an_all_day_event(): void
    {
        // User does not have any modules and tasks
        $user = User::factory()->createOne();
        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: B-CSI02XX',
                'description' => 'B-Prüfung/ Laborabschlussprüfung Cyber-Sicherheit',
                'location' => 'online',
                'related_id' => null,
                'related_type' => null,
                'is_editable' => true,
                'start' => Carbon::now()->startOfDay(),
                'end' => Carbon::now()->startOfDay(),
                'is_full_day' => true,
                'external_id' => null,
                'created_at' => '2023-11-16 12:00:00',
                'updated_at' => '2023-11-16 12:00:00',
            ],
        );

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('calendar'))
                ->waitUntilMissing('#nprogress', 2)
                ->scrollIntoView('.current-time-line')
                ->assertSee('Abgabetermin: B-CSI02XX')
                ->screenshot('calendar/test_it_shows_an_all_day_event');

        });
    }
}
