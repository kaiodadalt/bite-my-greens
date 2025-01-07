<?php

namespace App\Domain\ChallengeGroup\Services;

use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\Shared\Exceptions\DomainAuthorizationException;

class AuthorizeChallengeGroupService
{
    /**
     * @throws DomainAuthorizationException
     */
    public function canUpdate(int $user_id, ChallengeGroupEntity $challenge_group): void
    {
        if ($challenge_group->getOwnerId() !== $user_id) {
            throw new DomainAuthorizationException("You are not authorized to update this challenge group.");
        }
    }

    /**
     * @throws DomainAuthorizationException
     */
    public function canDelete(int $user_id, ChallengeGroupEntity $challenge_group, ): void
    {
        if ($challenge_group->getOwnerId() !== $user_id) {
            throw new DomainAuthorizationException("You are not authorized to delete this challenge group.");
        }
    }
}
