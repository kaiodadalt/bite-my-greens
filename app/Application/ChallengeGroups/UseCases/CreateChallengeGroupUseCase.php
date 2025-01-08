<?php

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\ChallengeGroups\DTOs\ChallengeGroupDTO;
use App\Application\Shared\UseCase;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Services\ChallengeGroupService;

readonly class CreateChallengeGroupUseCase extends UseCase
{
    public function __construct(
        private ChallengeGroupService $service
    ) {}

    public function execute(ChallengeGroupDTO $dto): ChallengeGroupEntity
    {
        return $this->service->create(new ChallengeGroupEntity(
            id: null,
            name: $dto->name,
            end_date: $dto->end_date,
            created_by: $dto->created_by
        ));
    }
}
