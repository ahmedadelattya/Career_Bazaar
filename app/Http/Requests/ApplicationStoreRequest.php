<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ApplicationStoreRequest extends FormRequest
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
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|phone:AUTO',
            'cover_letter' => 'required|string',
        ];
    }
}
