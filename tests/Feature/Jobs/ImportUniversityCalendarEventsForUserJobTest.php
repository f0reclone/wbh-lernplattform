<?php

namespace Feature\Jobs;

use App\Jobs\ImportUniversityCalendarEventsForUserJob;
use App\Models\Event;
use App\Models\User;
use Tests\TestCase;

class ImportUniversityCalendarEventsForUserJobTest extends TestCase
{

    public function test_it_does_nothing_without_a_calendar_url(): void
    {
        $user = User::factory()->createOne(['university_calendar_url' => null]);

        ImportUniversityCalendarEventsForUserJob::dispatchSync($user);

        $this->assertDatabaseCount('events', 0);
    }

    public function test_it_can_import_events(): void
    {
        $unrelatedUser = User::factory()->createOne();
        $unrelatedEvent = Event::factory()->createOne(['external_id' => 'random_1', 'user_id' => $unrelatedUser->id]);

        $user = User::factory()->createOne(['university_calendar_url' => __DIR__ . '/fixtures/calendar.ics']);
        $eventToDelete = Event::factory()->createOne(['external_id' => 'some random string', 'user_id' => $user->id]);

        ImportUniversityCalendarEventsForUserJob::dispatchSync($user);

        $this->assertDatabaseCount('events', 3);
        $this->assertDatabaseHas('events', [
            'external_id' => 'random_1',
            'user_id' => $unrelatedUser->id
        ]);
        $this->assertDatabaseHas('events', [
            'title' => 'Vortrag: Anwendung von KI-Sprachmodellen (u.a. ChatGPT) beim wissenschaftlichen Schreiben',
            'start' => '2024-02-05 17:00:00',
            'end' => '2024-02-05 18:30:00',
        ]);
        $this->assertDatabaseHas('events', [
            'title' => 'Abgabefrist für B-DBI02XX',
            'start' => '2023-10-07 22:00:00',
            'end' => '2023-10-08 21:59:00',
        ]);

        ImportUniversityCalendarEventsForUserJob::dispatchSync($user);


        $this->assertDatabaseCount('events', 3);
        $this->assertDatabaseHas('events', [
            'external_id' => 'random_1',
            'user_id' => $unrelatedUser->id
        ]);
        $this->assertDatabaseHas('events', [
            'title' => 'Vortrag: Anwendung von KI-Sprachmodellen (u.a. ChatGPT) beim wissenschaftlichen Schreiben',
            'start' => '2024-02-05 17:00:00',
            'end' => '2024-02-05 18:30:00',
        ]);
        $this->assertDatabaseHas('events', [
            'title' => 'Abgabefrist für B-DBI02XX',
            'start' => '2023-10-07 22:00:00',
            'end' => '2023-10-08 21:59:00',
            'is_full_day' => 1
        ]);

        Event::query()->where('title', '=', '')->update(['title' => 'test123', 'start' => '2024-10-07 12:00:00']);


        ImportUniversityCalendarEventsForUserJob::dispatchSync($user);


        $this->assertDatabaseCount('events', 3);
        $this->assertDatabaseHas('events', [
            'external_id' => 'random_1',
            'user_id' => $unrelatedUser->id
        ]);
        $this->assertDatabaseHas('events', [
            'title' => 'Vortrag: Anwendung von KI-Sprachmodellen (u.a. ChatGPT) beim wissenschaftlichen Schreiben',
            'start' => '2024-02-05 17:00:00',
            'end' => '2024-02-05 18:30:00',
            'user_id' => $user->id,
        ]);
        $this->assertDatabaseHas('events', [
            'title' => 'Abgabefrist für B-DBI02XX',
            'start' => '2023-10-07 22:00:00',
            'end' => '2023-10-08 21:59:00',
            'is_full_day' => 1,
            'user_id' => $user->id,
        ]);
    }
}
