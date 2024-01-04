<?php

namespace Tests\Feature\Models;

use App\Models\Event;
use App\Models\Module;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_retrieve_tasks_without_semesters()
    {
        $user = User::factory()->createOne();
        $module = Module::factory()->for($user)->createOne(['start_semester' => 3, 'end_semester' => 5]);
        $task = Task::factory()->for($user)->createOne([
            'related_type' => $module->getMorphClass(),
            'related_id' => $module->id,
        ]);
        $childTask = Task::factory()->for($user)->createOne(['parent_task_id' => $task->id, 'related_type' => 'hello', 'related_id' => 123]);
        self::assertEquals([3, 4, 5], $task->getSemesters());
        self::assertEquals([3, 4, 5], $childTask->getSemesters());

        $module->start_semester = 4;
        $module->end_semester = 3;
        $module->save();
        $task->refresh();
        $childTask->refresh();


        self::assertEquals([3, 4], $task->getSemesters());
        self::assertEquals([3, 4], $childTask->getSemesters());


        $module->start_semester = 5;
        $module->end_semester = 5;
        $module->save();

        $task = Task::query()->find($task->id);
        $childTask = Task::query()->find($childTask->id);


        self::assertEquals([5], $task->getSemesters());
        self::assertEquals([5], $childTask->getSemesters());

        $module->delete();
        $task = Task::query()->find($task->id);
        $childTask = Task::query()->find($childTask->id);

        self::assertEquals([], $task->getSemesters());
        self::assertEquals([], $childTask->getSemesters());

        $task = Task::query()->find($task->id);
        $childTask = Task::query()->find($childTask->id);
        $event = Event::factory()->for($user)->createOne();
        $task->related_type = $event->getMorphClass();
        $task->related_id = $event->id;
        $task->save();
        self::assertEquals([], $task->getSemesters());
        self::assertEquals([], $childTask->getSemesters());
    }
}
