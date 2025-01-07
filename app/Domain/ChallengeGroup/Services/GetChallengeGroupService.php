<?php

namespace App\Domain\ChallengeGroup\Services;

use App\Domain\Auth\Entities\UserEntity;
use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\Shared\Exceptions\DomainAuthorizationException;

readonly class GetChallengeGroupService
{
    public function __construct(
        private AuthorizeChallengeGroupService $auth,
        private ChallengeGroupRepository $repository,
    ) {}

    /**
     * @throws DomainAuthorizationException
     */
    public function get(UserEntity $user, ChallengeGroupEntity $challenge_group): ChallengeGroupEntity
    {
        $this->auth->canView($user->getId(), $challenge_group);
        return $this->repository->getById($challenge_group->getId());
    }
}
