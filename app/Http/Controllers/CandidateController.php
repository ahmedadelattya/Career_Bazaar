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

    public function search()
    {
        $keyword = request('que');
        $jobs = Job::where('title', 'LIKE', '%' . $keyword . '%')
            ->orWhere('description', 'LIKE', '%' . $keyword . '%')
            ->orWhere('location', 'LIKE', '%' . $keyword . '%')
            ->orWhere('category', 'LIKE', '%' . $keyword . '%')
            ->orWhere('experience_level', 'LIKE', '%' . $keyword . '%')
            ->get();
        // $jobs = Job::where('title', 'LIKE', '%' . request('que') . '%')->get();
        // return $jobs;
        return view('test', compact('jobs', 'keyword'));
        // dd("hi");
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
        $amount = request()->all()['amount'];

        $jobs = Job::where('salary_type', '=', $type)
            ->where($keyword, '>=', $amount)
            ->get();
        return view('test', compact('jobs'));
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
