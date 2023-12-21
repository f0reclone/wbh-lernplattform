<?php

namespace App\Console\Commands;

use App\Jobs\ImportUniversityCalendarEventsForUserJob;
use App\Models\User;
use Illuminate\Console\Command;

class ImportUniversityCalendarEventsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:calendar-import {userId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executes the import job for a specific user.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::query()->findOrFail($this->argument('userId'));

        ImportUniversityCalendarEventsForUserJob::dispatchSync($user);
    }
}
