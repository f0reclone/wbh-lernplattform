<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\ModuleStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ModuleCreateUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required', new Enum(ModuleStatus::class)],
            'start_semester' => ['numeric', 'integer', Rule::in(range(1, 10))],
            'end_semester' => ['numeric', 'integer', 'gte:start_semester', Rule::in(range(1, 10))],
        ];
    }
}
