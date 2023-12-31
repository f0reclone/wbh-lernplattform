<?php

namespace App\Models;

use App\Enums\ModuleStatus;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\ModuleFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Carbon;


/**
 * \App\Models\Module
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property ModuleStatus $status
 * @property int $user_id
 * @property int $start_semester
 * @property int $end_semester
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Event> $events
 * @property-read int|null $events_count
 * @property-read Collection<int, Exam> $exams
 * @property-read int|null $exams_count
 * @property-read Collection<int, Task> $tasks
 * @property-read int|null $tasks_count
 * @property-read User $user
 * @method static ModuleFactory factory($count = null, $state = [])
 * @method static Builder|Module newModelQuery()
 * @method static Builder|Module newQuery()
 * @method static Builder|Module query()
 * @method static Builder|Module whereCreatedAt($value)
 * @method static Builder|Module whereDescription($value)
 * @method static Builder|Module whereEndSemester($value)
 * @method static Builder|Module whereId($value)
 * @method static Builder|Module whereName($value)
 * @method static Builder|Module whereStartSemester($value)
 * @method static Builder|Module whereStatus($value)
 * @method static Builder|Module whereUpdatedAt($value)
 * @method static Builder|Module whereUserId($value)
 * @mixin Eloquent
 */
class Module extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => ModuleStatus::class,
    ];

    protected $guarded = [];

    public static function getStatusCases(): array
    {
        return array_map(
            fn(ModuleStatus $moduleStatus) => ['value' => $moduleStatus->value, 'name' => $moduleStatus->getName()],
            ModuleStatus::cases()
        );
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function events(): MorphToMany
    {
        return $this->morphToMany(Event::class, 'related');
    }

    public function getSemesters(): array
    {
        return range($this->start_semester, $this->end_semester);
    }
}
