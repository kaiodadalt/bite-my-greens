<?php

namespace App\Domain\ChallengeGroup\Services;

use App\Domain\Auth\Entities\UserEntity;
use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;

final readonly class AuthorizeChallengeGroupService
{
    public function __construct(
        private ChallengeGroupRepository $repository,
    ) {}

    public function canView(int $user_id, ChallengeGroupEntity $challenge_group): bool
    {
        return $challenge_group->hasOwner($user_id) || $this->repository->hasMember($challenge_group, $user_id);
    }

    public function cannotView(int $user_id, ChallengeGroupEntity $challenge_group): bool
    {
        return !$this->canView($user_id, $challenge_group);
    }

    public function cannotUpdate(int $user_id, ChallengeGroupEntity $challenge_group): bool
    {
        return !$challenge_group->hasOwner($user_id);
    }


    public function cannotDelete(int $user_id, ChallengeGroupEntity $challenge_group, ): bool
    {
        return !$challenge_group->hasOwner($user_id);
    }
}
