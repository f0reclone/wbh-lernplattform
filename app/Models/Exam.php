<?php

namespace App\Models;


use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\ExamFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Carbon;


/**
 * \App\Models\Exam
 *
 * @property int $id
 * @property string $code
 * @property int $module_id
 * @property int|null $grade
 * @property int|null $credit_points
 * @property int $semester
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Event> $events
 * @property-read int|null $events_count
 * @property-read Module $module
 * @method static ExamFactory factory($count = null, $state = [])
 * @method static Builder|Exam newModelQuery()
 * @method static Builder|Exam newQuery()
 * @method static Builder|Exam query()
 * @method static Builder|Exam whereCreatedAt($value)
 * @method static Builder|Exam whereCreditPoints($value)
 * @method static Builder|Exam whereGrade($value)
 * @method static Builder|Exam whereId($value)
 * @method static Builder|Exam whereModuleId($value)
 * @method static Builder|Exam whereSemester($value)
 * @method static Builder|Exam whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Exam extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const AVAILABLE_GRADES = [1, 1.3, 1.7, 2, 2.3, 2.7, 3, 3.3, 3.7, 4, 5];

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function events(): MorphToMany
    {
        return $this->morphToMany(Event::class, 'related');
    }

    public function getGrade(): ?float
    {
        if($this->grade === null) {
            return null;
        }

        return $this->grade / 10;
    }
}
