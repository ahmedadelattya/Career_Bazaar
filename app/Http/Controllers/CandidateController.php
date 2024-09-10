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
        $user = Auth::user();
        Gate::authorize('viewCandidateDashboard', Job::class);

        // Fetch only jobs with the status 'approved'
        $jobs = Job::where('status', 'approved')->paginate(10);
        $appliedJobs = Auth::user()->applications->pluck('job_id')->toArray();

        // Retrieve unread notifications for the logged-in user
        $notifications = $user->unreadNotifications;

        // Mark all notifications as read
        $user->unreadNotifications->markAsRead();
        return view('candidate-dashboard', compact('jobs', 'appliedJobs', 'notifications'));
    }
}
