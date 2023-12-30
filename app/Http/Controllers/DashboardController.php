<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use App\Models\Exam;
use App\Models\Module;
use App\Models\Task;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Enums\ModuleStatus;

class DashboardController extends Controller {
    public function index(Request $request) {
        $user_id = $request
            ->user()->id;
        $modules = Module::query()
            ->where('user_id', '=', $user_id)
            ->get();
        $tasks = Task::query()
            ->where('user_id', '=', $user_id)
            ->get();
        $events = Event::query()
            ->where('user_id', $user_id)
            ->where(function ($query) {
                // Events starting within the next seven days
                $query->whereDate('start', '>=', now()->toDateString())
                    ->whereDate('start', '<=', now()->addDays(7)->toDateString());

                // OR Events that started in the past and will end within the next seven days
                $query->orWhere(function ($query) {
                    $query->whereDate('end', '>=', now()->toDateString())
                        ->whereDate('end', '<=', now()->addDays(7)->toDateString());
                });
            })
            ->get();


        // Get all module ID's in one variable;
        // Also count the amount of modules done
        $module_ids = [];
        $modules_done = 0;
        foreach($modules as $module){
            $module_ids[] = $module->id;
            if ($module->status == ModuleStatus::WaitingForResult or
                $module->status == ModuleStatus::DoneWithGrade or
                $module->status == ModuleStatus::DoneWithoutGrade ){
                $modules_done++;
            }
        }

        // Now get all exams that belong to one of those modules
        $exams = Exam::query()->whereIn('module_id', $module_ids)->get();

        // Sum the amount of credit points over all exams and count those that are done
        // An exam is considered done if it has been graded with a passing grade <= 4
        // Also calculate the average grade over all exams, weighted by credit points
        $credit_points_total = 0;
        $credit_points_achieved = 0;
        $grade_sum = 0;
        foreach($exams as $exam) {
            if ($exam->grade <= 4) {
                $credit_points_achieved += $exam->credit_points;
                $credit_points_total += $exam->credit_points;
                $grade_sum += $exam->grade * $exam->credit_points;
            }
        }

        $grade_average = 0;
        if (count($exams) != 0){
            $grade_average = $grade_sum / count($exams);
        }

        return Inertia::render('Dashboard',
            ['credit_points_total' => $credit_points_total,
             'credit_points_achieved' => $credit_points_achieved,
             'modules_done' => $modules_done,
             'modules_total' => count($modules),
             'grade_average' => $grade_average,
             'tasks' => $tasks,
             'events' => $events
        ]);

    }
}
