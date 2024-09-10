<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $user = User::findOrFail(Auth::user()->id);
        $commonRules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ];
        // Role-specific rules
        if ($user->role === 'candidate') {
            return array_merge($commonRules, [
                'candidate_job_title' => ['nullable', 'string', 'max:255'],
                'candidate_job_description' => ['nullable', 'string', 'max:500'],
                'candidate_skills' => ['nullable', 'array'],
                'candidate_projects' => ['required', 'array'],
            ]);
        }

        if ($user->role === 'employer') {
            return array_merge($commonRules, [
                'company_name' => ['required', 'string', 'max:255'],
                'about' => ['nullable', 'string', 'max:255'],
                'website' => ['nullable', 'string', 'max:255', 'url'],
            ]);
        }

        return $commonRules; // Default rules if role is not matched
    }
}
//  public function rules(): array
//     {
//         $user = User::findOrFail(Auth::user()->id);
//         if($user->role === 'employer'){

//         }
//         return [
//             'name' => ['required', 'string', 'max:255'],
//             'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
//             'candidate_job_title' => ['nullable', 'string', 'max:255'],
//             'candidate_job_description' => ['nullable', 'string', 'max:500'],
//             'candidate_skills' => ['required', 'array'],
//             'candidate_projects' => ['required', 'array'],
//         ];
//     }
