<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExamCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', Rule::unique('exams', 'code')],
            'module_id' => ['required', 'int', 'numeric', Rule::exists('modules', 'id')],
            'semester' => ['required', 'int', 'numeric', 'min:1', 'max:10'],
            'credit_points' => ['required', 'int', 'numeric', 'min:0', 'max:30'],
            'exam_date' => ['nullable', 'date']
        ];
    }
}
