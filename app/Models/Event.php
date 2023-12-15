<?php

namespace App\Models;

use Carbon\Carbon;
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
 * @method static \Database\Factories\EventFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereIsEditable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereIsFullDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereRelatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereRelatedType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUserId($value)
 * @mixin \Eloquent
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
