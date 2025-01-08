<?php

namespace App\Domain\ChallengeGroup\Services;

use App\Domain\Auth\Entities\UserEntity;
use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\Shared\Exceptions\DomainAuthorizationException;

readonly class ChallengeGroupService
{
    public function __construct(
        private AuthorizeChallengeGroupService $auth,
        private ChallengeGroupRepository $repository,
    ) {}

    public function create(ChallengeGroupEntity $challenge_group): ChallengeGroupEntity
    {
        return $this->repository->create($challenge_group);
    }

    /**
     * @throws DomainAuthorizationException
     */
    public function get(UserEntity $user, ChallengeGroupEntity $challenge_group): ChallengeGroupEntity
    {
        $this->auth->canView($user->getId(), $challenge_group);
        return $this->repository->getById($challenge_group->getId());
    }

    /**
     * @throws DomainAuthorizationException
     */
    public function update(UserEntity $user, ChallengeGroupEntity $challenge_group): ChallengeGroupEntity
    {
        $this->auth->canUpdate($user->getId(), $challenge_group);
        return $this->repository->update($challenge_group);
    }

    /**
     * @throws DomainAuthorizationException
     */
    public function delete(UserEntity $user, ChallengeGroupEntity $challenge_group): bool
    {
        $this->auth->canDelete($user->getId(), $challenge_group);
        return $this->repository->delete($challenge_group);
    }
}
