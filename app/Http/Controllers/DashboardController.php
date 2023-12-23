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

class DashboardController extends Controller {
    public function index() {
        $user_id = User::query()->where('id', '=', 1)->get()[0]->id;
        $modules = Module::query()->where('user_id', '=', $user_id)->get();
        $tasks = Task::query()->where('user_id', '=', $user_id)->get();
        $events = Event::query()
            ->where('user_id', $user_id)
            ->whereDate('start', '>=', now()->toDateString())
            ->whereDate('start', '<=', now()->addDay()->toDateString())
            ->get();

        // Get all module ID's in one variable;
        // Also count the amount of modules done
        $module_ids = [];
        $modules_done = 0;
        foreach($modules as $module){
            $module_ids[] = $module->id;

            if ($module->status >= 100){
                $modules_done++;
            }
        }

        // Now get all exams that belong to one of those modules
        $exams = Exam::query()->whereIn('module_id', $module_ids)->get();

        // Sum the amount of credit points over all exams and count those that are done
        // An exam is considered done if it has been graded with a passing grade <= 4
        // Also calculate the average grade over all exams
        $credit_points_total = 0;
        $credit_points_achieved = 0;
        $grade_sum = 0;
        foreach($exams as $exam) {
            $credit_points_total += $exam->credit_points;
            $grade_sum += $exam->grade;

            if ($exam->grade <= 4) {
                $credit_points_achieved += $exam->credit_points;
            }
        }
        $grade_average = $grade_sum / count($exams);

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
