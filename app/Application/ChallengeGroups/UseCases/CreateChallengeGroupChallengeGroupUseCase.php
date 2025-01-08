<?php

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\Auth\DTOs\UserDTO;
use App\Application\ChallengeGroups\DTOs\ChallengeGroupDTO;
use App\Domain\Auth\Entities\UserEntity;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;

readonly class CreateChallengeGroupChallengeGroupUseCase extends ChallengeGroupUseCase
{
    public function execute(UserDTO $user_dto, ChallengeGroupDTO $challenge_group_dto): ChallengeGroupEntity
    {
        return $this->service->create(
            new UserEntity(...$user_dto),
            new ChallengeGroupEntity(...$challenge_group_dto)
        );
    }
}
