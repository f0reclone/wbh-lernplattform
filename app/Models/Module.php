<?php

namespace App\Models;

use App\Enums\ModuleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;



/**
 * \App\Models\Module
 *
 * @property int $id
 * @property string $name
 * @property ModuleStatus $status
 * @property int $user_id
 * @property int $start_semester
 * @property int $end_semester
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Event> $events
 * @property-read int|null $events_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exam> $exams
 * @property-read int|null $exams_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read int|null $tasks_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ModuleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Module newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Module newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Module query()
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereEndSemester($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereStartSemester($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereUserId($value)
 * @mixin \Eloquent
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
