<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ExamCreateRequest;
use App\Http\Requests\ExamUpdateRequest;
use App\Http\Resources\ModuleResource;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use App\Models\Module;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Exam::class, 'exam');
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $exams = Exam::query()
            ->with('module')
            ->whereHas('module', fn(Builder $builder) => $builder->where('user_id', '=', $user->id))
            ->get();

        return Inertia::render('Exams/Index', [
            'exams' => ExamResource::collection($exams)->collection
        ]);
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $modules = Module::query()
            ->where('user_id', '=', $user->id)
            ->get();

        return Inertia::render('Exams/Create', [
            'modules' => ModuleResource::collection($modules)->collection,
            'selectedModuleId' => $request->get('moduleId'),
        ]);
    }

    public function edit(Exam $exam, Request $request)
    {
        $user = $request->user();
        $modules = Module::query()
            ->where('user_id', '=', $user->id)
            ->get();

        return Inertia::render('Exams/Edit', [
            'exam' => ExamResource::make($exam),
            'modules' => ModuleResource::collection($modules)->collection,
        ]);
    }
    public function update(Exam $exam, ExamUpdateRequest $request)
    {
        $user = $request->user();
        $exam->fill($request->validated());
        $grade = $request->get('grade');
        if($grade !== null) {
            $exam->grade = (int) ($grade * 10);
        }
        if(!$user->hasAccessToModule(Module::query()->firstOrFail($exam->module_id))) {
            abort('User does not have access to module.');
        }
        $exam->save();

        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Aufgabe gespeichert.'
        ]);

        return redirect()->route('exams.index');
    }

    public function store(ExamCreateRequest $request)
    {
        $user = $request->user();
        $data = $request->validated();

        $exam = new Exam();
        $exam->fill($data);

        if(!$user->hasAccessToModule(Module::query()->firstOrFail($exam->module_id))) {
            abort('User does not have access to module.');
        }
        $exam->save();

        return redirect()->route('exams.index');
    }

    public function destroy(Exam $exam, Request $request)
    {
        $exam->delete();

        return redirect()->route('exams.index');
    }
}
