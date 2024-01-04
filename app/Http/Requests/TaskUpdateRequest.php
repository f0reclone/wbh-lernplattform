<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class TaskUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['string', 'min:1', 'max:255'],
            'description' => ['string'],
            'status' => ['required', new Enum(TaskStatus::class)],
            'module_id' => ['int', 'numeric', Rule::exists('modules', 'id')],
        ];
    }
}
