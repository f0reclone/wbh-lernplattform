<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index(Request $request) {
        $tasks = Task::query()->where('user_id', '=', $request->user()->id)->get();

        return Inertia::render('Task', [
            'tasks' => TaskResource::collection($tasks)->collection,
        ]);
    }
}
