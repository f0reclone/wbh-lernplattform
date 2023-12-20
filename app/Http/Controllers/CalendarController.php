<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CalendarController extends Controller
{
    public function index(Request $request) {
        $events = Event::query()
            ->where('user_id', '=', $request->user()->id)
            ->whereNotNull('id')
            ->get();

        return Inertia::render('Calendar', [
            'events' => EventResource::collection($events)->collection,
        ]);
    }
}
