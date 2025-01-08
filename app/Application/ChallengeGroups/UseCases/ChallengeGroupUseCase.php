<?php

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\Auth\DTOs\UserDTO;
use App\Application\ChallengeGroups\DTOs\ChallengeGroupDTO;
use App\Application\Shared\UseCase;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Services\ChallengeGroupService;

abstract readonly class ChallengeGroupUseCase extends UseCase
{
    public function __construct(
        protected ChallengeGroupService $service
    ) {}

    public abstract function execute(UserDTO $user_dto, ChallengeGroupDTO $challenge_group_dto): ChallengeGroupEntity|bool;
}
