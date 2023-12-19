<?php

namespace App\Jobs;

use App\Models\Event;
use App\Models\User;
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
        if($this->user->university_calendar_url === null) {
            Log::info('User does not have a university calendar url configured.', [
                'user' => $this->user,
            ]);
        }

        $ical = new ICal($this->user->university_calendar_url);
        $events = Event::query()
            ->where('user_id', '=', $this->user->id)
            ->whereNotNull('external_id')
            ->get()
            ->keyBy('external_id');

        $iCalEvents = collect($ical->events());
        foreach($iCalEvents as $iCalEvent) {
            /** @var \ICal\Event $iCalEvent */
            $event = $events->pull($iCalEvent->uid);
            if($event === null) {
                $event = new Event();
                $event->external_id = $iCalEvent->uid;
                $event->user_id = $this->user->id;
            }

            $event->start = $iCalEvent->dtstart;
            $event->end = $iCalEvent->dtend;
            $event->title = $iCalEvent->summary;
            $event->description = $iCalEvent->description;
            $event->location = $iCalEvent->location;
        }
    }
}
