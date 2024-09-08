<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    if (Auth::user()->role == 'employer') {
        return redirect()->route('jobs.index');
    } else if (Auth::user()->role == 'candidate') {
        return redirect()->route('candidate.dashboard');
    } else if (Auth::user()->role == 'admin') {
        return view('admin-dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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

Route::middleware(['auth'])->group(function () {
    Route::get('/candidate/dashboard', [JobController::class, 'candidateDashboard'])->name('candidate.dashboard');
    Route::get('/employer/jobs/{job}/applications', [ApplicationController::class, 'manageApplications'])->name('employer.applications');
    Route::put('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'apply'])->name('jobs.apply');
});

require __DIR__ . '/auth.php';
