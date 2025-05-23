<?php

declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Services;

use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;

final readonly class AuthorizeChallengeGroupService
{
    public function __construct(
        private ChallengeGroupRepository $repository,
    ) {}

    public function canView(int $user_id, ChallengeGroupEntity $challenge_group): bool
    {
        if ($challenge_group->hasOwner($user_id)) {
            return true;
        }

        return $this->repository->hasMember($challenge_group->getId(), $user_id);
    }

    public function cannotView(int $user_id, ChallengeGroupEntity $challenge_group): bool
    {
        return ! $this->canView($user_id, $challenge_group);
    }

    public function cannotUpdate(int $user_id, ChallengeGroupEntity $challenge_group): bool
    {
        return ! $challenge_group->hasOwner($user_id);
    }

    public function cannotDelete(int $user_id, ChallengeGroupEntity $challenge_group): bool
    {
        return ! $challenge_group->hasOwner($user_id);
    }

    public function canPost(int $user_id, ChallengeGroupEntity $challenge_group): bool
    {
        if ($challenge_group->hasOwner($user_id)) {
            return true;
        }

        return $this->repository->hasMember($challenge_group->getId(), $user_id);
    }

    public function cannotPost(int $user_id, ChallengeGroupEntity $challenge_group): bool
    {
        return ! $this->canPost($user_id, $challenge_group);
    }
}
