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
        // $user->candidate_skills = json_decode($user->candidate_skills, true);
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
            // $user->candidate_skills = json_decode($user->candidate_skills, true);
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
        // Handle image upload
        if ($request->hasFile('image')) {
            $this->handleImageUpload($request, $user);
        }
        //common fields
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Handle role-specific fields
        if ($user->role === 'candidate') {
            $user->candidate_skills = $request->input('candidate_skills');
            $user->candidate_projects = $request->input('candidate_projects');
            $user->candidate_job_description = $request->input('candidate_job_description');
            $user->candidate_job_title = $request->input('candidate_job_title');
        } elseif ($user->role === 'employer') {
            $user->company_name = $request->input('company_name');
            $user->about = $request->input('about');
            $user->website = $request->input('website');
        }
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


    /**
     * Handle image upload process.
     *
     * @param ProfileUpdateRequest $request
     * @param User $user
     */
    private function handleImageUpload(ProfileUpdateRequest $request, User $user): void
    {
        // Delete old image if exists
        if ($user->image) {
            $oldImagePath = public_path("images/{$user->role}s/{$user->image}");
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Store new image
        $image = $request->file('image');
        $directory = $user->role === 'candidate' ? 'candidates_images' : 'employers_images';
        $newImagePath = $image->store('images', $directory);

        $user->image = $newImagePath; // Update user image path
    }
}
