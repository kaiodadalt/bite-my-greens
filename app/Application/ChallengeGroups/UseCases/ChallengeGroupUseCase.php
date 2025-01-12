<?php

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\Auth\DTOs\UserDTO;
use App\Application\ChallengeGroups\DTO\ChallengeGroupDTO;
use App\Application\Shared\DTO;
use App\Application\Shared\UseCase;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Services\ChallengeGroupService;

abstract readonly class ChallengeGroupUseCase extends UseCase
{
    public function __construct(
        protected ChallengeGroupService $service
    ) {}
}
