<?php

namespace App\Http\Resources;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Event $resource
 */
class EventResource extends JsonResource
{
    public static $wrap = null;


    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'location' => $this->resource->location,
            'relatedType' => $this->resource->related_type,
            'relatedId' => $this->resource->related_id,
            'isEditable' => $this->resource->is_editable,
            'time' => $this->resource->getTime(),
            'isFullDay' => $this->resource->is_full_day,
            'createdAt' => $this->resource->created_at,
            'updatedAt' => $this->resource->updated_at,
        ];
    }
}
