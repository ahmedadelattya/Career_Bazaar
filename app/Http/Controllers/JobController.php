<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function create()
    {
        $skills = Skill::all();
        return view('employer.jobs.job-create', compact('skills'));
    }

    public function store(Request $request)
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
        $user = Auth::user();

        if ($user->role === 'employer') {
            $jobs = $user->jobs()->paginate(10);
            return view('employer.jobs.index', compact('jobs'));
        } else {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }
    }

    public function show($id)
    {
        // Find the job by ID
        $job = Job::findOrFail($id);

        // Decode the skills JSON string into an array
        $job->skills = json_decode($job->skills, true);

        return view('employer.jobs.show', compact('job'));
    }

    public function edit($id)
    {
        // Find the job by ID
        $job = Job::findOrFail($id);

        // Decode the skills JSON string into an array
        $job->skills = json_decode($job->skills, true);

        // Fetch all skills from the database
        $allSkills = Skill::all();

        return view('employer.jobs.edit', compact('job', 'allSkills'));
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

        // Delete the job
        $job->delete();

        // Redirect with success message
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }
}
