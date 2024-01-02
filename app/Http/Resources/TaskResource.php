<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Module;
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
            'status' => $this->resource->status->value,
            'moduleName' => $this->resource->getModuleName(),
            'semesters' => $this->resource->getSemesters(),
            'all_semesters' => $allSemesters,
            'statusName' => $this->resource->status->getName(),
            'moduleId' => $this->resource->module_id,
            'module' => ModuleResource::make($this->whenLoaded('module')),
            'createdAt' => $this->resource->created_at,
            'updatedAt' => $this->resource->updated_at,
        ];
    }
}
