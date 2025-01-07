<?php

namespace App\Domain\ChallengeGroup\Services;

use App\Domain\Auth\Entities\UserEntity;
use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\Shared\Exceptions\DomainAuthorizationException;
use App\Domain\Shared\Exceptions\DomainException;

readonly class UpdateChallengeGroupService
{
    public function __construct(
        private AuthorizeChallengeGroupService $auth,
        private ValidateChallengeGroupService $validator,
        private ChallengeGroupRepository $repository,
    ) {}

    /**
     * @throws DomainException|DomainAuthorizationException
     */
    public function update(UserEntity $user, ChallengeGroupEntity $challenge_group): ChallengeGroupEntity
    {
        $this->auth->canUpdate($user->getId(), $challenge_group);
        $this->validator->validate($challenge_group);
        return $this->repository->update($challenge_group);
    }
}
