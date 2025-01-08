<?php

namespace App\Domain\ChallengeGroup\Services;

use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\Shared\Exceptions\DomainAuthorizationException;

readonly class AuthorizeChallengeGroupService
{
    public function __construct(
        private ChallengeGroupRepository $repository,
    ) {}

    /**
     * @throws DomainAuthorizationException
     */
    public function canView(int $user_id, ChallengeGroupEntity $challenge_group): void
    {
        if (!$challenge_group->hasOwner($user_id) || !$this->repository->hasMember($challenge_group, $user_id)) {
            throw new DomainAuthorizationException("You are not authorized to view this challenge group.");
        }
    }

    /**
     * @throws DomainAuthorizationException
     */
    public function canUpdate(int $user_id, ChallengeGroupEntity $challenge_group): void
    {
        if (!$challenge_group->hasOwner($user_id)) {
            throw new DomainAuthorizationException("You are not authorized to update this challenge group.");
        }
    }

    /**
     * @throws DomainAuthorizationException
     */
    public function canDelete(int $user_id, ChallengeGroupEntity $challenge_group, ): void
    {
        if ($challenge_group->hasOwner($user_id)) {
            throw new DomainAuthorizationException("You are not authorized to delete this challenge group.");
        }
    }
}
