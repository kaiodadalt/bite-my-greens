<?php

namespace App\Domain\ChallengeGroup\Services;

use App\Domain\Auth\Entities\UserEntity;
use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\Shared\Exceptions\DomainAuthorizationException;

readonly class DeleteChallengeGroupService
{
    public function __construct(
        private AuthorizeChallengeGroupService $auth,
        private ChallengeGroupRepository $repository,
    ) {}

    /**
     * @throws DomainAuthorizationException
     */
    public function delete(UserEntity $user, ChallengeGroupEntity $challenge_group): bool
    {
        $this->auth->canDelete($user->getId(), $challenge_group);
        return $this->repository->delete($challenge_group);
    }
}
