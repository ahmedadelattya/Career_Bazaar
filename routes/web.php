<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Auth\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    if (Auth::user()->role == 'employer') {
        return redirect()->route('jobs.index');
    } else if (Auth::user()->role == 'candidate') {
        return view('candidate-dashboard', ['jobs' => Job::all()]);
    } else if (Auth::user()->role == 'admin') {
        return view('admin-dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/employer', [ProfileController::class, 'show'])->name('profile.show'); // this route tests profile view for candidate and employer
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
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

require __DIR__ . '/auth.php';
