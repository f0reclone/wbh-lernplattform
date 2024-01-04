<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Exam $resource
 */
class ExamResource extends JsonResource
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
            'code' => $this->resource->code,
            'grade' => $this->resource->getGrade(),
            'creditPoints' => $this->resource->credit_points,
            'semester' => $this->resource->semester,
            'moduleId' => $this->resource->module_id,
            'module' => ModuleResource::make($this->whenLoaded('module')),
            'examDate' => $this->resource->examEvent()?->getTime()['start'],
            'createdAt' => $this->resource->created_at,
            'updatedAt' => $this->resource->updated_at,
        ];
    }
}
