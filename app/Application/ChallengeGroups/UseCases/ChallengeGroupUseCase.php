<?php

declare(strict_types=1);

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\Shared\UseCase;
use App\Domain\ChallengeGroup\Services\ChallengeGroupService;
use App\Domain\ChallengeGroup\Services\ChallengeGroupUserService;

abstract readonly class ChallengeGroupUseCase extends UseCase
{
    public function __construct(
        protected ChallengeGroupService $service,
        protected ChallengeGroupUserService $participant_service,
    ) {}
}
