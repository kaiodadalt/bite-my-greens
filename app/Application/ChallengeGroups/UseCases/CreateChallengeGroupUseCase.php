<?php

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\ChallengeGroups\DTOs\CreateChallengeGroupDTO;
use App\Application\UseCase;
use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Services\ChallengeGroupValidationService;
use App\Domain\DomainException;

readonly class CreateChallengeGroupUseCase extends UseCase
{
    public function __construct(
        private ChallengeGroupRepository        $repository,
        private ChallengeGroupValidationService $validator
    ) {}

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws DomainException
     */
    public function execute(CreateChallengeGroupDTO $dto): ChallengeGroupEntity
    {
        $this->authorize('create', ChallengeGroupEntity::class);
        $challenge_group = new ChallengeGroupEntity(
            id: null,
            name: $dto->name,
            end_date: $dto->end_date,
            created_by: $dto->created_by
        );
        $this->validator->validate($challenge_group);
        return $this->repository->save($challenge_group);
    }
}
