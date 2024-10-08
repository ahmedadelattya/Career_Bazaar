<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Job;
use App\Models\Skill;

class CandidateController extends Controller
{
    public function candidateDashboard()
    {
        $user = Auth::user();
        Gate::authorize('viewCandidateDashboard', Job::class);

        // Fetch only jobs with the status 'approved'
        $jobs = Job::where('status', 'approved')->get();
        $skills = Skill::all();
        $appliedJobs = Auth::user()->applications->pluck('job_id')->toArray();

        // Retrieve unread notifications for the logged-in user
        $notifications = $user->unreadNotifications;

        // Mark all notifications as read
        $user->unreadNotifications->markAsRead();
        return view('candidate-dashboard', compact('jobs', 'appliedJobs', 'notifications', 'skills'));
    }

    public function search()
    {
        $keyword = request('que');
        // Ensure 'status' is 'approved' and add other search conditions
        $jobs = Job::where('status', 'approved')  // Filter by 'approved' status
            ->where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('location', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('category', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('experience_level', 'LIKE', '%' . $keyword . '%');
            })
            ->get();
        $user = Auth::user();
        $skills = Skill::all();
        $appliedJobs = Auth::user()->applications->pluck('job_id')->toArray();

        // Retrieve unread notifications for the logged-in user
        $notifications = $user->unreadNotifications;

        // Mark all notifications as read
        $user->unreadNotifications->markAsRead();
        return view('candidate-dashboard', compact('jobs', 'appliedJobs', 'notifications', 'skills'));
        return view('test', compact('jobs', 'keyword'));
    }



    public function filterSalary()
    {
        // dd(request()->all());
        $type = request()->all()['salary_type'];

        if ($type == 'fixed') {
            $keyword = 'fixed_salary';
        } else {
            $keyword = 'hourly_rate';
        }
        $min = request('min');
        $max = request('max');
        if ($min > $max) {
            $min = 1;
            $max = 10000000;
        }
        $jobs = Job::where('salary_type', '=', $type)
            ->where($keyword, '>=', $min)
            ->where($keyword, '<=', $max)->where('status', '=', 'approved')
            ->get();
        $user = Auth::user();
        $skills = Skill::all();
        $appliedJobs = Auth::user()->applications->pluck('job_id')->toArray();

        // Retrieve unread notifications for the logged-in user
        $notifications = $user->unreadNotifications;

        // Mark all notifications as read
        $user->unreadNotifications->markAsRead();
        return view('candidate-dashboard', compact('jobs', 'appliedJobs', 'notifications', 'skills'));

        return redirect()->back()->with('jobs', $jobs);
    }

    public function filterSkills()
    {
        $keyword = request('select_skill');
        // dd($keyword);
        $jobs = Job::where('skills', 'LIKE', '%' . $keyword . '%')->get();
        $user = Auth::user();
        $skills = Skill::all();
        $appliedJobs = Auth::user()->applications->pluck('job_id')->toArray();

        // Retrieve unread notifications for the logged-in user
        $notifications = $user->unreadNotifications;

        // Mark all notifications as read
        $user->unreadNotifications->markAsRead();
        return view('candidate-dashboard', compact('jobs', 'appliedJobs', 'notifications', 'skills'));

        return view("test", compact('jobs'));
    }


    public function filterDate()
    {
        // dd(request(['start', 'end']));
        $start = request('start');
        $end = request('end');
        // dd(date('Y-m-d'));
        $jobs = Job::where('created_at', '>=', $start)
            ->where('created_at', '<=', $end)
            ->get();
        $user = Auth::user();
        $skills = Skill::all();
        $appliedJobs = Auth::user()->applications->pluck('job_id')->toArray();

        // Retrieve unread notifications for the logged-in user
        $notifications = $user->unreadNotifications;

        // Mark all notifications as read
        $user->unreadNotifications->markAsRead();
        return view('candidate-dashboard', compact('jobs', 'appliedJobs', 'notifications', 'skills'));

        return view("test", compact('jobs'));
    }
    // public function filter()
    // {
    //     $keyword = request('sal');
    //     $jobs = Job::where('salary_type', '=', 'fixed')
    //         ->where('fixed_salary', '>=', $keyword)
    //         ->get();
    //     // dd($keyword);
    //     return view('test', compact('jobs', 'keyword'));
    // }


}
