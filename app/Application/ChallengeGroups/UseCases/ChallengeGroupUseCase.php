<?php

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\Shared\UseCase;
use App\Domain\ChallengeGroup\Services\ChallengeGroupService;

abstract readonly class ChallengeGroupUseCase extends UseCase
{
    public function __construct(
        protected ChallengeGroupService $service
    ) {}
}
