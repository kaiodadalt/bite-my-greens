<?php

namespace App\Domain\ChallengeGroup\Services;

use App\Domain\Auth\Entities\UserEntity;
use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\Shared\Exceptions\DomainAuthorizationException;

final readonly class AuthorizeChallengeGroupService
{
    public function __construct(
        private ChallengeGroupRepository $repository,
    ) {}

    /**
     * @throws DomainAuthorizationException
     */
    public function canView(UserEntity $user, ChallengeGroupEntity $challenge_group): void
    {
        if (!$challenge_group->hasOwner($user->getId()) || !$this->repository->hasMember($challenge_group, $user->getId())) {
            throw new DomainAuthorizationException("You are not authorized to view this challenge group.");
        }
    }

    /**
     * @throws DomainAuthorizationException
     */
    public function canUpdate(UserEntity $user, ChallengeGroupEntity $challenge_group): void
    {
        if (!$challenge_group->hasOwner($user->getId())) {
            throw new DomainAuthorizationException("You are not authorized to update this challenge group.");
        }
    }

    /**
     * @throws DomainAuthorizationException
     */
    public function canDelete(UserEntity $user, ChallengeGroupEntity $challenge_group, ): void
    {
        if ($challenge_group->hasOwner($user->getId())) {
            throw new DomainAuthorizationException("You are not authorized to delete this challenge group.");
        }
    }
}
