<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\ExamResource;
use App\Http\Resources\ModuleResource;
use App\Http\Resources\TaskResource;
use App\Models\Exam;
use App\Models\Module;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $tasks = Task::query()
            ->with('module')
            ->where('user_id', '=', $user->id)
            ->get();

        $modules = $tasks->pluck('module')->unique('id')->values();

        return Inertia::render('Task/Index', [
            'tasks' => TaskResource::collection($tasks)->collection,
            'modules' => ModuleResource::collection($modules)->collection,
        ]);
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $modules = Module::query()
            ->where('user_id', '=', $user->id)
            ->get();

        return Inertia::render('Task/Create', [
            'modules' => ModuleResource::collection($modules)->collection,
            'selectedModuleId' => $request->get('moduleId'),
        ]);
    }

    public function edit(Task $task, Request $request)
    {
        $user = $request->user();
        $modules = Module::query()
            ->where('user_id', '=', $user->id)
            ->get();

        return Inertia::render('Task/Edit', [
            'task' => TaskResource::make($task),
            'modules' => ModuleResource::collection($modules)->collection,
            'taskStatusValues' =>  Task::getStatusCases()
        ]);
    }
    public function update(Task $task, TaskUpdateRequest $request)
    {
        $task->fill($request->validated());
        $task->save();

        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Aufgabe gespeichert.'
        ]);

        return redirect()->route('tasks.index');
    }

    public function store(TaskCreateRequest $request)
    {
        $user = $request->user();

        $data = $request->validated();
        $task = new Task();
        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->module_id = $data['moduleId'];
        $task->status = TaskStatus::Open->value;
        $task->user_id = $user->id;
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task, Request $request)
    {
        $user = $request->user();
        $task->delete();

        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Aufgabe erfolgreich gelöscht.'
        ]);


        return redirect()->route('tasks.index');
    }
}
