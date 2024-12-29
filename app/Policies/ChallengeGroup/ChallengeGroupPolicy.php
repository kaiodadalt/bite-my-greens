<?php

namespace App\Policies\ChallengeGroup;

use App\Models\Auth\User;
use App\Models\ChallengeGroups\ChallengeGroup;

class ChallengeGroupPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Allow viewing any challenge groups if the user has a specific role or permission
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ChallengeGroup $challenge_group): bool
    {
        return $user->id === $challenge_group->created_by;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ChallengeGroup $challenge_group): bool
    {
        return $user->id === $challenge_group->created_by;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ChallengeGroup $challenge_group): bool
    {
        return $user->id === $challenge_group->created_by;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ChallengeGroup $challenge_group): bool
    {
        return $user->id === $challenge_group->created_by;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ChallengeGroup $challenge_group): bool
    {
        return false;
    }
}
