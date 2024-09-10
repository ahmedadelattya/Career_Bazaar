<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Notifications\JobStatusNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{


    public function getAllJobs(Request $request)
    {
        Gate::authorize('viewAdminDashboard', Job::class);
        return view('admin-dashboard', ['jobs' => Job::get()->where('status', '=', 'pending')]);
    }

    public function approveJob($jobId)
    {

        $job = Job::find($jobId);
        $job->status = 'approved';
        $job->save();
        $admin = User::where('id', '=', Auth::user()->id)->first();
        $admin->notify(new JobStatusNotification($job, 'approved'));
        $employer = User::findOrFail($job->user->id);
        // $employer->notify(new JobStatusNotification($job, 'approved'));
        return redirect()->back()->with('success', 'Job approved and admin notified.');
        // return redirect()->back();
    }

    public function rejectJob($jobId)
    {

        $job = Job::find($jobId);
        $job->status = 'declined';
        $job->save();
        $admin = User::where('id', '=', Auth::user()->id)->first();
        $admin->notify(new JobStatusNotification($job, 'declined'));
        $employer = User::findOrFail($job->user->id);
        $employer->notify(new JobStatusNotification($job, 'declined'));

        return redirect()->back()->with('success', 'Job rejected and admin notified.');

        // return redirect()->back();
    }
}
