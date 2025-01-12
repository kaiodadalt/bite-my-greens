<?php

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\Auth\DTOs\UserDTO;
use App\Application\ChallengeGroups\DTO\ChallengeGroupDTO;
use App\Application\ChallengeGroups\DTO\CreateChallengeGroupDTO;
use App\Application\Shared\DTO;
use App\Domain\Auth\Entities\UserEntity;
use App\Domain\ChallengeGroup\Data\CreateChallengeGroupData;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;

readonly class CreateChallengeGroupChallengeGroupUseCase extends ChallengeGroupUseCase
{
    public function execute(UserDTO $user_dto, CreateChallengeGroupDTO $creation_data): ChallengeGroupEntity
    {
        return $this->service->create(
            new CreateChallengeGroupData(
                $creation_data->name,
                $creation_data->end_date,
                $user_dto->id
            )
        );
    }
}
