<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ModuleResource;
use App\Http\Resources\TaskResource;
use App\Models\Module;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Task;

class BoardController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();
        $tasks = Task::query()
            ->where('user_id', '=', $user->id)
            ->get();
        $modules = Module::query()
            ->where('user_id', '=', $user->id)
            ->get();

        return Inertia::render('Board', [
            'tasks' => TaskResource::collection($tasks)->collection,
            'modules' => ModuleResource::collection($modules)->collection,
            'taskStatusValues' =>  Task::getStatusCases()
        ]);
    }


}
