<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Application;
use App\Models\User;

class ApplicationPolicy
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
    // public function view(User $user, Application $application)
    // {
    //     return $user->id === $application->user_id;
    // }
    public function view(User $user, Application $application)
    {
        return $user->id === $application->user_id || 
               $user->id === $application->jobPost->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to view this application.');
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
    public function update(User $user, Application $application)
    {
        return $user->id === $application->jobPost->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to update this application.');
    }
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Application $application): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Application $application): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Application $application): bool
    {
        return false;
    }
}
