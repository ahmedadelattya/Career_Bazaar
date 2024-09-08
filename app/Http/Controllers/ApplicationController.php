<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class ApplicationController extends Controller
{
    public function apply(Request $request, $jobId)
    {
        $job = Job::findOrFail($jobId);

        Gate::authorize('apply', $job);

        // Validate and create application
        $request->validate([
            'cover_letter' => 'required|string',
        ]);
        Application::create([
            'job_id' => $job->id,
            'candidate_id' => Auth::id(),
            'cover_letter' => $request->cover_letter,
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
