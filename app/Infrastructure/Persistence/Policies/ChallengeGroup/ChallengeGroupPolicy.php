<?php

namespace App\Infrastructure\Persistence\Policies\ChallengeGroup;

use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Infrastructure\Persistence\Models\Auth\User;

class ChallengeGroupPolicy
{
    public function create(User $user): bool
    {
        return true;
    }

    public function view(User $user, ChallengeGroupEntity $challenge_group): bool
    {
        return $user->id === $challenge_group->created_by;
    }

    public function update(User $user, ChallengeGroupEntity $challenge_group): bool
    {
        return $user->id === $challenge_group->created_by;
    }

    public function delete(User $user, ChallengeGroupEntity $challenge_group): bool
    {
        return $user->id === $challenge_group->created_by;
    }
}
