<?php

namespace App\Http\Requests;

use App\Enums\TaskStatusEnums;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'status' => ['sometimes', Rule::enum(TaskStatusEnums::class)],
        ];
    }
}
