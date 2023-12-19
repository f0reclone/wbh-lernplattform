<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\EventFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $key
 * @property string $title
 * @property string|null $description
 * @property string|null $location
 * @property int $user_id
 * @property string|null $related_type
 * @property int|null $related_id
 * @property int $is_editable
 * @property \Illuminate\Support\Carbon $start
 * @property \Illuminate\Support\Carbon $end
 * @property int $is_full_day
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static EventFactory factory($count = null, $state = [])
 * @method static Builder|Event newModelQuery()
 * @method static Builder|Event newQuery()
 * @method static Builder|Event query()
 * @method static Builder|Event whereCreatedAt($value)
 * @method static Builder|Event whereDescription($value)
 * @method static Builder|Event whereEnd($value)
 * @method static Builder|Event whereId($value)
 * @method static Builder|Event whereIsEditable($value)
 * @method static Builder|Event whereIsFullDay($value)
 * @method static Builder|Event whereKey($value)
 * @method static Builder|Event whereLocation($value)
 * @method static Builder|Event whereRelatedId($value)
 * @method static Builder|Event whereRelatedType($value)
 * @method static Builder|Event whereStart($value)
 * @method static Builder|Event whereTitle($value)
 * @method static Builder|Event whereUpdatedAt($value)
 * @method static Builder|Event whereUserId($value)
 * @mixin Eloquent
 */
class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    protected $guarded = [];

    public function getTime(): array
    {
        return [
            'start' => $this->getFormattedDate($this->start),
            'end' => $this->getFormattedDate($this->end)
        ];
    }

    private function getFormattedDate(Carbon $date):string
    {
        if($this->is_full_day) {
            return $date->timezone('Europe/Berlin')->toDateString();
        }

        return $date->timezone('Europe/Berlin')->toDateTimeString('minute');
    }
}
