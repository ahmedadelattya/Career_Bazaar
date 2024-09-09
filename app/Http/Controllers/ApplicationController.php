<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ApplicationStoreRequest;



class ApplicationController extends Controller
{
    public function apply(ApplicationStoreRequest $request, $jobId)
    {
        $job = Job::findOrFail($jobId);
        $user = Auth::user();
        Gate::authorize('apply', $job);

        // Check if the user has already applied for this job
        if (Application::where('job_id', $jobId)->where('candidate_id', $user->id)->exists()) {
            return back()->withErrors(['You have already applied for this job.']);
        }

        // Handle the file upload
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('', 'application_resumes'); // Store file in 'public/resumes'
        }



        Application::create([
            'job_id' => $job->id,
            'candidate_id' => Auth::id(),
            'cover_letter' => $request->cover_letter,
            'resume' => $resumePath,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        return redirect()->route('candidate.dashboard')->with('success', 'Application submitted successfully!');
    }

    public function manageApplications($jobId)
    {
        $job = Job::findOrFail($jobId);

        // Ensure that the employer owns the job
        Gate::authorize('update', $job);


        $applications = $job->applications()->with('candidate')->get();

        return view('employer.jobs.applications', compact('applications', 'job'));
    }

    public function updateStatus(Request $request, $applicationId)
    {
        $application = Application::findOrFail($applicationId);

        // Ensure that the employer owns the job associated with the application
        Gate::authorize('update', $application->job);

        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $application->update(['status' => $request->status]);

        // Notify the candidate
        // $application->candidate->notify(new ApplicationStatusNotification($application));

        return redirect()->route('employer.applications', $application->job_id)
            ->with('success', 'Application status updated!');
    }
}
