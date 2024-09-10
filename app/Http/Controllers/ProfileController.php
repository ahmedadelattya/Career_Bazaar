<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployerUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

    public function show()
    {
        // testing employer profile with route /profile/employer
        $user = Auth::user();
        if ($user->role == 'employer') {
            return view('profiles.employer.show-employer-profile', compact('user'));
        } else {
            return view('profiles.candidate.show-candidate-profile', compact('user'));
        }
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        $user = $request->user();

        // Determine which profile view to return based on role
        if ($user->role == 'employer') {
            return view('profiles.employer.edit-employer-profile', ['user' => $user]);
        } elseif ($user->role == 'candidate') {
            $skills = Skill::all();

            return view('profiles.candidate.edit-candidate-profile', ['user' => $user, 'skills' => $skills]);
        } elseif ($user->role == 'admin') {
            return view('profiles.admin-profile', ['user' => $user]);
        }

        abort(403, 'Unauthorized action.');
    }
    /**
     * Update the user's profile information.
     */
    // public function update(EmployerUpdateRequest $requestEmployer): RedirectResponse
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // dd(request()->all());
        $user = User::findOrFail(Auth::user()->id);
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $image_path = "images/{$user->role}s/{$user->image}";

        if ($user->image != null) {
            if (file_exists(public_path($image_path))) {
                unlink(public_path($image_path));
            }
        }
        $image = $request->file('image');
        if ($request->hasFile('image')) {
            $image_path = $image->store("images", "{$user->role}s_images");
        }
        if ($request->has('name') && $request->name) {
            $user->name = $request->name;
        }
        if ($request->has('email') && $request->email) {
            $user->email = $request->email;
        }
        if ($request->has('candidate_skills') && $request->candidate_skills) {
            $skills = $request->input('candidate_skills', []);
            $user->candidate_skills = json_encode($skills);
        }
        if ($request->has('candidate_projects') && $request->candidate_projects != null) {
            $user->candidate_projects = $request->candidate_projects;
        }
        if ($request->has('candidate_job_description') && $request->candidate_job_description) {
            $user->candidate_job_description = $request->candidate_job_description;
        }
        if ($request->has('candidate_job_title') && $request->candidate_job_title) {
            $user->candidate_job_title = $request->candidate_job_title;
        }
        if ($request->has('company_name') && $request->company_name) {
            $user->company_name = $request->company_name;
        }
        if ($request->has('about') && $request->about) {
            $user->about = $request->about;
        }
        if ($request->has('website') && $request->website) {
            $user->website = $request->website;
        }
        if ($request->hasFile('image') && $image_path) {
            $user->image = $image_path;
        }

        $user->update();

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

    // public function show()
    // {

    //     return view('profiles.show-candidate-profile', ['user' => Auth::user()]);
    // }
}
