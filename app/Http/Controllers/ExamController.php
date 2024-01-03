<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ExamCreateRequest;
use App\Http\Requests\ExamUpdateRequest;
use App\Http\Resources\ModuleResource;
use App\Http\Resources\ExamResource;
use App\Models\Event;
use App\Models\Exam;
use App\Models\Module;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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

        $modules = $exams->pluck('module')->unique('id')->values();

        return Inertia::render('Exams/Index', [
            'exams' => ExamResource::collection($exams)->collection,
            'modules' => ModuleResource::collection($modules)->collection
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

        $data = $request->validated();
        $exam->fill(Arr::except($data, ['grade', 'exam_date']));
        $grade = $request->get('grade');
        if($grade !== null) {
            $exam->grade = (int) ($grade * 10);
        }

        $examDate = $data['exam_date'] ?? null;
        $this->syncExamEvent($examDate, $exam);

        if(!$user->hasAccessToModule(Module::query()->findOrFail($exam->module_id))) {
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
        $exam->fill(Arr::except($data, ['exam_date']));

        $examDate = $data['exam_date'] ?? null;
        $this->syncExamEvent($examDate, $exam);

        if(!$user->hasAccessToModule(Module::query()->findOrFail($exam->module_id))) {
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

    private function syncExamEvent(?string $examDate, Exam $exam)
    {
        $examEvent = $exam->examEvent();
        if($examDate === null && $examEvent !== null) {
            $examEvent->delete();

            return;
        }
        if($examDate !== null) {
            if($examEvent === null) {
                $examEvent = new Event();
            }
            $examEvent->key = 'exam';
            $examEvent->title = 'Prüfungstermin: ' . $exam->code;
            $examEvent->description = 'Modul: ' . $exam->module->name;
            $examEvent->user_id = $exam->module->user_id;
            $examEvent->is_editable = true;
            $examEvent->is_full_day = true;
            $examEvent->start = Carbon::parse($examDate, 'Europe/Berlin');
            $examEvent->end = $examEvent->start;
            $examEvent->related_type = $exam->getMorphClass();
            $examEvent->related_id = $exam->id;
            $examEvent->save();
        }
    }
}
