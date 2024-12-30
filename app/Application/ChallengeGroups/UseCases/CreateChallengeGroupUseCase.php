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
        private ChallengeGroupValidationService $validation_service
    ) {}

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws DomainException
     */
    public function execute(CreateChallengeGroupDTO $dto): ChallengeGroupEntity
    {
        $this->authorize('create', ChallengeGroupEntity::class);
        $this->validation_service->validateEndDate($dto->end_date);

        return $this->repository->save(new ChallengeGroupEntity(
            id: null,
            name: $dto->name,
            end_date: $dto->end_date,
            created_by: $dto->created_by
        ));
    }
}
