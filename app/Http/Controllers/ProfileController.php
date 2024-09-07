<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        // Determine which profile view to return based on role
        if ($user->role == 'employer') {
            return view('profiles.employer-profile', ['user' => $user]);
        } elseif ($user->role == 'candidate') {
            return view('profiles.edit-candidate-profile', ['user' => $user]);
        } elseif ($user->role == 'admin') {
            return view('profiles.admin-profile', ['user' => $user]);
        }

        return abort(403, 'Unauthorized action.');
    }
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $request->user()->fill($request->validated());


        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user = User::findOrFail(Auth::user()->id);

        $user->candidate_skills = $request->candidate_skills;
        $user->candidate_projects = $request->candidate_projects;
        $user->candidate_job_description = $request->candidate_job_title;
        $user->candidate_job_title = $request->candidate_job_description;
        $user->save();

        // $user = User::create([

        //     'candidate_skills' => $request->candidate_skills,
        //     'candidate_projects' => $request->candidate_projects,
        // ]);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show()
    {

        return view('profiles.show-candidate-profile', ['user' => Auth::user()]);
    }
}
