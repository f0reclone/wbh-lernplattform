<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Carbon;


/**
 * App\Models\Task
 *
 * @property int $id
 * @property int|null $parent_task_id
 * @property string $title
 * @property string $description
 * @property int $user_id
 * @property string $status
 * @property string $related_type
 * @property int $related_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Event> $events
 * @property-read int|null $events_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\File> $files
 * @property-read int|null $files_count
 * @property-read Model|\Eloquent $module
 * @property-read Task|null $parentTask
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\TaskFactory factory($count = null, $state = [])
 * @method static Builder|Task newModelQuery()
 * @method static Builder|Task newQuery()
 * @method static Builder|Task query()
 * @method static Builder|Task whereCreatedAt($value)
 * @method static Builder|Task whereDescription($value)
 * @method static Builder|Task whereId($value)
 * @method static Builder|Task whereParentTaskId($value)
 * @method static Builder|Task whereRelatedId($value)
 * @method static Builder|Task whereRelatedType($value)
 * @method static Builder|Task whereStatus($value)
 * @method static Builder|Task whereTitle($value)
 * @method static Builder|Task whereUpdatedAt($value)
 * @method static Builder|Task whereUserId($value)
 * @mixin \Eloquent
 */
class Task extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function parentTask(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'parent_task_id');
    }

    public function childTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_task_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function related(): MorphTo
    {
        return $this->morphTo('related');
    }

    public function files(): MorphToMany
    {
        return $this->morphToMany(File::class, 'related');
    }

    public function events(): MorphToMany
    {
        return $this->morphToMany(Event::class, 'related');
    }

    public function getProgress(): float
    {
        if ($this->status === 'closed') {
            return 1;
        }

        $tasks = $this->childTasks()->get();

        if ($tasks->isEmpty()) {
            return 0;
        }

        return $tasks->where('status', '=', 'closed')->count() / $tasks->count();
    }

    public function getSemesters(): array
    {
        if($this->parent_task_id !== null) {
            return $this->parentTask->getSemesters();
        }

        $this->loadMissing('related');
        $module = $this->related;
        if (!$module instanceof Module) {
            return [];
        }

        $semesters = array_unique(range($module->start_semester, $module->end_semester));
        sort($semesters);

        return array_values($semesters);
    }

}
