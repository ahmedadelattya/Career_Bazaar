<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Allow only employers or admins to view any job
        return $user->role === 'employer' || $user->role === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Job $job): bool
    {
        // Allow only the job owner (employer) or admin to view the job
        return $user->id === $job->employer_id || $user->role === 'admin' ||  $user->role === 'candidate';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Allow only employers to create jobs
        return $user->role === 'employer';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Job $job): bool
    {
        // Allow only the job owner (employer) to update the job
        return $user->id === $job->employer_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Job $job): bool
    {
        // Allow only the job owner (employer) to delete the job
        return $user->id === $job->employer_id;
    }

    /**
     * Determine whether the user can view the candidate dashboard.
     */
    public function viewCandidateDashboard(User $user): bool
    {
        // Allow only candidates to view the candidate dashboard
        return $user->role === 'candidate';
    }

    /**
     * Determine whether the user can apply for the job.
     */
    public function apply(User $user, Job $job): bool
    {
        // Allow only candidates to apply for jobs
        return $user->role === 'candidate';
    }
}
