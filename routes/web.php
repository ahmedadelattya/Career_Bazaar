<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
 

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    if(Auth::user()->role=='employer'){
        return view('employer-dashboard');
    } else if  (Auth::user()->role=='candidate'){
        return view('candidate-dashboard');
    } else if (Auth::user()->role=='admin'){
    return view('admin-dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


