<?php

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\ChallengeGroups\DTOs\CreateChallengeGroupDTO;
use App\Application\Shared\UseCase;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Services\CreateChallengeGroupService;
use App\Domain\Shared\Exceptions\DomainException;

readonly class CreateChallengeGroupUseCase extends UseCase
{
    public function __construct(
        private CreateChallengeGroupService $service
    ) {}

    /**
     * @throws DomainException
     */
    public function execute(CreateChallengeGroupDTO $dto): ChallengeGroupEntity
    {
        return $this->service->create(new ChallengeGroupEntity(
            id: null,
            name: $dto->name,
            end_date: $dto->end_date,
            created_by: $dto->created_by
        ));
    }
}
