<?php

namespace App\Providers;

use App\Policies\JobPolicy;
use app\Models\Job;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();
        // Paginator::useBootstrapFive();
        Gate::policy(Job::class, JobPolicy::class);
    }
}
