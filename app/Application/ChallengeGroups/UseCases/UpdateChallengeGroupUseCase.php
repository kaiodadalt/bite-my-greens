<?php

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\ChallengeGroups\DTOs\UpdateChallengeGroupDTO;
use App\Application\UseCase;
use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Services\ChallengeGroupValidationService;
use App\Domain\DomainException;

readonly class UpdateChallengeGroupUseCase extends UseCase
{
    public function __construct(
        private ChallengeGroupRepository        $repository,
        private ChallengeGroupValidationService $validator
    ) {}

    /**
     * @throws DomainException
     */
    public function execute(UpdateChallengeGroupDTO $dto): ChallengeGroupEntity
    {
        $challenge_group = new ChallengeGroupEntity(
            id: $dto->id,
            name: $dto->name,
            end_date: $dto->end_date,
            created_by: $dto->created_by
        );
        $this->validator->validate($challenge_group);
        return $this->repository->update($challenge_group);
    }
}
