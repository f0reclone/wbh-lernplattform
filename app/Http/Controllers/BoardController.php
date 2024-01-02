<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ModuleResource;
use App\Http\Resources\TaskResource;
use App\Models\Module;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Task;

class BoardController extends Controller
{
    public function index() {
        $user_id = User::query()
            ->where('id', '=', 1)
            ->get()[0]->id;
        $tasks = Task::query()
            ->where('user_id', '=', $user_id)
            ->get();
        $modules = Module::query()
            ->where('user_id', '=', $user_id)
            ->get();

        return Inertia::render('Board', [
            'tasks' => TaskResource::collection($tasks)->collection,
            'modules' => ModuleResource::collection($modules)->collection,
            'taskStatusValues' =>  Task::getStatusCases()
        ]);
    }


}
