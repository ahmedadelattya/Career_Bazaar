<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployerUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Validation\Rule;

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
            return view('profiles.candidate-profile', ['user' => $user]);
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
        $image_path = public_path('images/employers/' . $user->image);
        if ($user->image != null) {
            # code...
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        if ($request->hasFile('image')) {
            // dd("FILE RECeieved");
            $image = $request->file('image');
            $image_path = $image->store("images", 'employers_images');
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->candidate_skills = $request->candidate_skills;
        $user->candidate_projects = $request->candidate_projects;
        $user->candidate_job_description = $request->candidate_job_description;
        $user->candidate_job_title = $request->candidate_job_title;
        $user->company_name = $request->company_name;
        $user->about = $request->about;
        $user->website = $request->website;
        $user->image = $image_path;

        $user->save();

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
}
