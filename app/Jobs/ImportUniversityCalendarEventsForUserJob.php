<?php

namespace App\Jobs;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use ICal\Event as ICalEvent;
use ICal\ICal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ImportUniversityCalendarEventsForUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->user->university_calendar_url === null) {
            Log::info('User does not have a university calendar url configured.', [
                'user' => $this->user,
            ]);
        }

        $iCal = new ICal($this->user->university_calendar_url);
        $events = Event::query()
            ->where('user_id', '=', $this->user->id)
            ->whereNotNull('external_id')
            ->get()
            ->keyBy('id');

        foreach ($iCal->events() as $iCalEvent) {

            /** @var ICalEvent $iCalEvent */
            $event = new Event();
            $event->external_id = $iCalEvent->uid;
            $event->user_id = $this->user->id;
            $event->key = 'university_external';
            $event->is_editable = false;
            $event->related_type = null;
            $event->related_id = null;
            // There is no property for is_full_day
            // For now we will assume that the event starts at 00:00 and ends at 23:59
            $event->is_full_day = str_ends_with($iCalEvent->dtstart, 'T000000') &&
                str_ends_with($iCalEvent->dtend, 'T235900');

            $event->start = Carbon::createFromTimestampUTC($iCalEvent->dtstart_array[2]);
            $event->end = Carbon::createFromTimestampUTC($iCalEvent->dtend_array[2]);
            $event->title = $iCalEvent->summary;
            $event->description = $iCalEvent->description;
            $event->location = $iCalEvent->location;

            // Since the uid from WBH is not fixed by event we have to perform a workaround (:facepalm)
            // Check if any event matches via common identifiers (title, time, description)
            $savedEvent = $events->firstWhere(
                fn(Event $savedEvent) => $savedEvent->getIdentifiersAsArray() === $event->getIdentifiersAsArray()
            );
            if ($savedEvent !== null) {
                // In case there is a match, we pull it from the event list and continue (no update required)
                $events->pull($savedEvent->id);
                continue;
            }

            // No match, we need to save the new event
            $event->save();
        }

        // Delete all saved events which were not matched (case it was removed or updated)
        foreach ($events as $event) {
            $event->delete();
        }
    }
}
