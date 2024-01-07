<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Http\Resources\ModuleResource;
use Inertia\Inertia;
use App\Models\Exam;
use App\Models\Module;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Enums\ModuleStatus;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request
            ->user()->id;
        $modules = Module::query()
            ->with('tasks')
            ->where('user_id', '=', $user_id)
            ->get();
        $events = Event::query()
            ->where('user_id', $user_id)
            ->where(function ($query) {
                $query->orWhere(function ($query) {
                    // Either Events starting within the next seven days
                    $query->whereDate('start', '>=', now()->toDateString())
                        ->whereDate('start', '<=', now()->addDays(7)->toDateString());
                });
                $query->orWhere(function ($query) {
                    // OR Events that started in the past and will end within the next seven days
                    $query->whereDate('end', '>=', now()->toDateString())
                        ->whereDate('end', '<=', now()->addDays(7)->toDateString());
                });
            })
            ->get();


        $modules_done = 0;
        foreach ($modules as $module) {
            if ($module->status === ModuleStatus::WaitingForResult ||
                $module->status === ModuleStatus::DoneWithGrade ||
                $module->status === ModuleStatus::DoneWithoutGrade) {
                $modules_done++;
            }
        }

        // Now get all exams that belong to one of those modules
        $exams = Exam::query()->whereIn('module_id', $modules->pluck('id'))->get();


        // Sum the amount of credit points over all exams and count those that are done
        // An exam is considered done if it has been graded with a passing grade <= 4
        // Also calculate the average grade over all exams, weighted by credit points
        $creditPointsTotal = 0;
        $creditPointsAchieved = 0;
        $grade_sum = 0;
        foreach ($exams as $exam) {
            if ($exam->grade !== null && $exam->grade <= 40) {
                $creditPointsAchieved += $exam->credit_points;
                $grade_sum += $exam->grade * $exam->credit_points;
            }
            $creditPointsTotal += $exam->credit_points;
        }

        $gradeAverage = 0;
        if ($creditPointsAchieved != 0) {
            $gradeAverage = round($grade_sum / $creditPointsAchieved / 10, 1);
        }

        return Inertia::render(
            'Dashboard',
            [
                'credit_points_total' => $creditPointsTotal,
                'credit_points_achieved' => $creditPointsAchieved,
                'modules' => ModuleResource::collection($modules->filter(fn(Module $module) => $module->tasks->where('status', '=', TaskStatus::InProgress)->isNotEmpty())->take(6))->collection,
                'modules_done' => $modules_done,
                'modules_total' => count($modules),
                'grade_average' => $gradeAverage,
                'events' => $events
            ]
        );
    }
}
