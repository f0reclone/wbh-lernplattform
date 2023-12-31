<?php

namespace App\Http\Resources;

use App\Models\Event;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Task $resource
 */
class TaskResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $allSemesters = Task::getAllSemesters();

        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'status' => $this->resource->status,
            'module' => $this->resource->getModuleName(),
            'semesters' => $this->resource->getSemesters(),
            'all_semesters' => $allSemesters,
            'createdAt' => $this->resource->created_at,
            'updatedAt' => $this->resource->updated_at,
        ];
    }
}
