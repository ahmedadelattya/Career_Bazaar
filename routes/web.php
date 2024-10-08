<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;



Route::get('/', function () {
    // Check if the user is authenticated
    if (Auth::check()) {
        // Redirect to the dashboard if authenticated
        return redirect('/dashboard');
    }
    // Redirect to the login page if not authenticated
    return redirect('/login');
});

Route::get('/dashboard', function () {
    if (Auth::user()->role == 'employer') {
        return redirect()->route('jobs.index');
    } else if (Auth::user()->role == 'candidate') {
        return redirect()->route('candidate.dashboard');
    } else if (Auth::user()->role == 'admin') {
        return redirect()->route('admin.dash');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show'); // this route tests profile view for candidate and employer
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');


//Employer_jobs Routing
Route::middleware(['auth'])->group(function () {
    Route::get('/employer/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/employer/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/employer/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/employer/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
    Route::get('/employer/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/employer/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/employer/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
});

// testing comment routes
Route::middleware('auth')->group(function () {
    Route::post('/employer/jobs/{job}', [CommentController::class, 'store'])->name('comment-store');
});

// Admin Routes

// routes/web.php


Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'getAllJobs'])->name('admin.dash');
    Route::put('/admin/jobs/{job}/approve', [AdminController::class, 'approveJob'])->name('jobs.approve');
    Route::put('/admin/jobs/{job}/reject', [AdminController::class, 'rejectJob'])->name('jobs.reject');
    Route::post('/admin/jobs/export', [AdminController::class, 'exportJobs'])->name('jobs.export');
});

// Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');


Route::middleware(['auth'])->group(function () {
    Route::get('/candidate/dashboard', [CandidateController::class, 'candidateDashboard'])->name('candidate.dashboard');
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'apply'])->name('jobs.apply');
    Route::get('/employer/jobs/{job}/applications', [ApplicationController::class, 'manageApplications'])->name('employer.applications');
    Route::put('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');
});

// these routes are for searching and filtering jobs at candidate dashboard view
Route::middleware(['auth'])->group(function () {
    // Route::get('/search', SearchController::class);
    Route::get('/searching', [CandidateController::class, 'search'])->name('search');
    Route::get('/filtering', [CandidateController::class, 'filterSalary'])->name('filter');
    Route::get('/filterskills', [CandidateController::class, 'filterSkills'])->name('skillsearch');
    Route::get('/filterdate', [CandidateController::class, 'filterDate'])->name('datesearch');
});
require __DIR__ . '/auth.php';



Route::get('auth/github', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github');

Route::get('/auth/github/callback', function () {


    $user = Socialite::driver('github')->stateless()->user();


    // Find or create the user in your database
    $authUser = User::firstOrCreate(
        ['email' => $user->email],
        [
            'name' => $user->getNickname(),
            'github_id' => $user->id,
            'avatar' => $user->avatar,
            'password' => $user->token

        ]
    );

    Auth::login($authUser);

    return redirect('/dashboard');
});
