<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller
{
    public function create()
    {
        Gate::authorize('create', Job::class);
        $skills = Skill::all();
        $locations = [
            "Cairo, Egypt",
            "Alexandria, Egypt",
            "Assiut, Egypt",
            "Aswan, Egypt",
            "Beheira, Egypt",
            "Bani Suef, Egypt",
            "Daqahliya, Egypt",
            "Damietta, Egypt",
            "Fayyoum, Egypt",
            "Gharbiya, Egypt",
            "Giza, Egypt",
            "Ismailia, Egypt",
            "Kafr El Sheikh, Egypt",
            "Luxor, Egypt",
            "Marsa Matrouh, Egypt",
            "Minya, Egypt",
            "Monofiya, Egypt",
            "New Valley, Egypt",
            "North Sinai, Egypt",
            "Port Said, Egypt",
            "Red Sea, Egypt",
            "Sharqiya, Egypt",
            "Sohag, Egypt",
            "South Sinai, Egypt",
            "Suez, Egypt",
            "Tanta, Egypt"
        ];
        $categories = ["Programming", "Management", "IT"];
        $experienceLevel = ["Internship", "Entry Level", "Junior", "Mid Level", "Senior"];
        return view('employer.jobs.job-create', compact('skills', 'locations', 'categories', 'experienceLevel'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Job::class);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'location' => 'required|string',
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
            'skills.*' => 'string', // Each skill should be a string
        ]);

        // Convert skills input to an array
        $skills = $request->input('skills', []);

        // Prepare the data to be saved
        $data = $request->except('skills'); // Exclude 'skills' from the $data array
        $data['skills'] = json_encode($skills); // Convert the array to a JSON string
        $data['employer_id'] = Auth::id(); // Assign the current employer's ID

        // Create the job listing
        Job::create($data);

        // Redirect with success message
        return redirect()->route('jobs.index')->with('success', 'Job posted successfully!');
    }


    public function index()
    {
        Gate::authorize('viewAny', Job::class);
        $user = Auth::user();
        $jobs = $user->jobs()->paginate(9);
        return view('employer.jobs.index', compact('jobs'));
    }

    public function show($id)
    {

        // Find the job by ID
        $job = Job::findOrFail($id);

        Gate::authorize('view', $job);

        // Decode the skills JSON string into an array
        $job->skills = json_decode($job->skills, true);

        return view('employer.jobs.show', compact('job'));
    }

    public function edit($id)
    {
        // Find the job by ID
        $job = Job::findOrFail($id);

        Gate::authorize('update', $job);

        // Decode the skills JSON string into an array
        $job->skills = json_decode($job->skills, true);
        $skills = Skill::all();
        $locations = [
            "Cairo, Egypt",
            "Alexandria, Egypt",
            "Assiut, Egypt",
            "Aswan, Egypt",
            "Beheira, Egypt",
            "Bani Suef, Egypt",
            "Daqahliya, Egypt",
            "Damietta, Egypt",
            "Fayyoum, Egypt",
            "Gharbiya, Egypt",
            "Giza, Egypt",
            "Ismailia, Egypt",
            "Kafr El Sheikh, Egypt",
            "Luxor, Egypt",
            "Marsa Matrouh, Egypt",
            "Minya, Egypt",
            "Monofiya, Egypt",
            "New Valley, Egypt",
            "North Sinai, Egypt",
            "Port Said, Egypt",
            "Red Sea, Egypt",
            "Sharqiya, Egypt",
            "Sohag, Egypt",
            "South Sinai, Egypt",
            "Suez, Egypt",
            "Tanta, Egypt"
        ];
        $categories = ["Programming", "Management", "IT"];
        $experienceLevel = ["Internship", "Entry Level", "Junior", "Mid Level", "Senior"];

        // Fetch all skills from the database
        $allSkills = Skill::all();

        return view('employer.jobs.edit', compact('job', 'allSkills', 'skills', 'locations', 'categories', 'experienceLevel'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'location' => 'required|string',
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
            'skills.*' => 'string',
        ]);

        // Find the job by ID
        $job = Job::findOrFail($id);

        Gate::authorize('update', $job);

        // Convert skills input to an array
        $skills = $request->input('skills', []);

        // Prepare the data to be updated
        $data = $request->except('skills'); // Exclude 'skills' from the $data array
        $data['skills'] = json_encode($skills); // Convert the array to a JSON string

        // Update the job listing
        $job->update($data);

        // Redirect with success message
        return redirect()->route('jobs.index')->with('success', 'Job updated successfully!');
    }

    public function destroy($id)
    {
        // Find the job by ID
        $job = Job::findOrFail($id);

        Gate::authorize('delete', $job);

        // Delete the job
        $job->delete();

        // Redirect with success message
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }
}
