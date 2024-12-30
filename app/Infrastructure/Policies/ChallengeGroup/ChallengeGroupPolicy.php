<?php

namespace App\Infrastructure\Policies\ChallengeGroup;

use App\Infrastructure\Persistence\Models\Auth\User;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;

class ChallengeGroupPolicy
{
    public function view(User $user, ChallengeGroup $challenge_group): bool
    {
        return $user->id === $challenge_group->created_by;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ChallengeGroup $challenge_group): bool
    {
        return $user->id === $challenge_group->created_by;
    }

    public function delete(User $user, ChallengeGroup $challenge_group): bool
    {
        return $user->id === $challenge_group->created_by;
    }
}
