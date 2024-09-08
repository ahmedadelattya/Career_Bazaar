<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function showRegistrationForm(Request $request)
    {
        $role = $request->input('role');

        if ($role === 'employer') {
            return redirect()->route('employer-register');
        } elseif ($role === 'candidate') {
            return redirect()->route('candidate-register');
        }

        return back()->withErrors(['role' => 'Invalid role selected.']);
    }

    public function showEmployerRegisterForm()
    {
        return view('auth.employer-register');
    }

    public function showCandidateRegisterForm()
    {
        return view('auth.candidate-register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'role' => ['required', Rule::in(['candidate', 'employer'])],
        ];

        // Additional validation rules for role-specific fields
        if ($request->role === 'employer') {
            $rules = array_merge($rules, [
                'company_name' => ['required', 'string', 'max:255'],
                'website' => ['nullable', 'url'],
            ]);
        }

        $validatedData = $request->validate($rules);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'company_name' => $request->input('company_name', null),
            'website' => $request->input('website', null),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
