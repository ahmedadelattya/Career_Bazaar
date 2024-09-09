<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'category' => 'required|string|exists:categories,name',
            'location' => 'required|string|exists:locations,name',
            'salary_type' => 'required|string|in:fixed,hourly',
            'fixed_salary' => [
                'nullable',
                'required_if:salary_type,fixed',
                'numeric',
            ],
            'hourly_rate' => [
                'nullable',
                'required_if:salary_type,hourly',
                'numeric',
            ],
            'skills' => 'array',
            'skills.*' => 'string|exists:skills,name',
            'job_type' => 'required|string|in:full-time,part-time,hybrid',
            'work_place' => 'required|string|in:on-site,remote,hybrid',
            'experience_level' => 'required|string|in:entry-level,intermediate,expert',
        ];
    }
}
