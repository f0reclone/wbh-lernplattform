<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Database\Factories\TaskFactory;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


/**
 * \App\Models\Task
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $user_id
 * @property TaskStatus $status
 * @property int $module_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Event> $events
 * @property-read int|null $events_count
 * @property-read Module $module
 * @property-read User $user
 * @method static TaskFactory factory($count = null, $state = [])
 * @method static Builder|Task newModelQuery()
 * @method static Builder|Task newQuery()
 * @method static Builder|Task query()
 * @method static Builder|Task whereCreatedAt($value)
 * @method static Builder|Task whereDescription($value)
 * @method static Builder|Task whereId($value)
 * @method static Builder|Task whereModuleId($value)
 * @method static Builder|Task whereStatus($value)
 * @method static Builder|Task whereTitle($value)
 * @method static Builder|Task whereUpdatedAt($value)
 * @method static Builder|Task whereUserId($value)
 * @mixin Eloquent
 */
class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => TaskStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function getModuleName(): ?string
    {
        $module = $this->module;
        return $module?->name;
    }

    public function events(): MorphToMany
    {
        return $this->morphToMany(Event::class, 'related');
    }

    public function getSemesters(): array
    {
        $module = $this->module;
        if ($module) {
            return range($module->start_semester, $module->end_semester);
        }
        return [];
    }

    public static function getAllSemesters(): array
    {
        $startSemesters = DB::table('modules')->distinct()->pluck('start_semester')->filter()->toArray();
        $endSemesters = DB::table('modules')->distinct()->pluck('end_semester')->filter()->toArray();
        $numericSemesters = array_filter($startSemesters, function ($semester) {
            return is_numeric($semester);
        });

        // Loop through each module to include semesters in between
        foreach ($startSemesters as $startSemester) {
            $numericSemesters = array_merge($numericSemesters, range($startSemester, $endSemesters[$startSemester] ?? $startSemester));
        }

        // Remove duplicates and sort the semesters
        $numericSemesters = array_unique($numericSemesters);
        sort($numericSemesters);

        return $numericSemesters;
    }

    public static function getStatusCases(): array
    {
        return array_map(
            fn(TaskStatus $taskStatus) => ['value' => $taskStatus->value, 'name' => $taskStatus->getName()],
            TaskStatus::cases()
        );
    }

}
