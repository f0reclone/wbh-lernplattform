<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ModuleCreateUpdateRequest;
use App\Http\Resources\ModuleResource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\ExamResource;
use App\Models\Module;
use App\Models\User;
use App\Models\Task;
use App\Models\Exam;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ModuleController extends Controller
{
    public function index(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $modules = Module::query()
            ->where('user_id', '=', $user->id)
            ->get();
        return Inertia::render('Module/Index', [
            'modules' => ModuleResource::collection($modules)->collection,
            'moduleStatusCases' => Module::getStatusCases()
        ]);
    }

    public function create()
    {
        return Inertia::render('Module/Create', [
            'moduleStatusCases' => Module::getStatusCases()
        ]);
    }

    public function store(ModuleCreateUpdateRequest $moduleCreateRequest)
    {
        $data = $moduleCreateRequest->validated();

        $module = Module::query()->make($data);
        $module->user_id = $moduleCreateRequest->user()->id;
        $module->save();

        return redirect()->route('modules');
    }

    public function edit(Request $request, Module $module)
    {
        return Inertia::render('Module/Edit', [
            'module' => ModuleResource::make($module),
            'moduleStatusCases' => Module::getStatusCases()
        ]);
    }

    public function update(ModuleCreateUpdateRequest $moduleCreateRequest, Module $module)
    {
        $data = $moduleCreateRequest->validated();
        $module->fill($data);
        $module->save();

        return redirect()->route('modules');
    }

    public function show(Request $request, Module $module)
    {
        $user = $request->user();

        // Fetch tasks for the specific module and user
        $tasks = Task::query()
            ->where('user_id', '=', $user->id)
            ->where('module_id', '=', $module->id)
            ->get();
        $exams = Exam::query()
            ->where('module_id', '=', $module->id)
            ->get();

        return Inertia::render('Module/Show', [
            'module' => ModuleResource::make($module),
            'moduleStatusCases' => Module::getStatusCases(),
            'tasks' => TaskResource::collection($tasks)->collection,
            'exams' => ExamResource::collection($exams)->collection
        ]);
    }

}
