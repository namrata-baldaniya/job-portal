<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\JobPost;
use App\Models\User;

class JobPostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, JobPost $jobPost): bool
    {
        return $user->id === $jobPost->user_id || $user->isAdmin();
    }
    
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, JobPost $jobPost): bool
    {
        return $user->id === $jobPost->user_id;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, JobPost $jobPost): bool
    {
        return $user->id === $jobPost->user_id;

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, JobPost $jobPost): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, JobPost $jobPost): bool
    {
        return false;
    }
}
