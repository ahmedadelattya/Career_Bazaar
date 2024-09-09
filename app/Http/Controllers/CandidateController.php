<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Job;


class CandidateController extends Controller
{
    public function candidateDashboard()
    {
        Gate::authorize('viewCandidateDashboard', Job::class);

        // Fetch only jobs with the status 'approved'
        $jobs = Job::where('status', 'approved')->paginate(10);
        $appliedJobs = Auth::user()->applications->pluck('job_id')->toArray();
        return view('candidate-dashboard', compact('jobs', 'appliedJobs'));
    }
}
