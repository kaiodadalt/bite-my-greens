<?php

namespace App\Domain\ChallengeGroup\Services;

use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\Shared\Exceptions\DomainException;

readonly class CreateChallengeGroupService
{
    public function __construct(
        private ValidateChallengeGroupService $validator,
        private ChallengeGroupRepository $repository,
    ) {}

    /**
     * @throws DomainException
     */
    public function create(ChallengeGroupEntity $challenge_group): ChallengeGroupEntity
    {
        $this->validator->validate($challenge_group);
        return $this->repository->create($challenge_group);
    }
}
