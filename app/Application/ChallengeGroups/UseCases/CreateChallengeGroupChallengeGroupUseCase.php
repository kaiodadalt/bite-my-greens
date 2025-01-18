<?php

declare(strict_types=1);

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\ChallengeGroups\DTO\CreateChallengeGroupDTO;
use App\Domain\ChallengeGroup\Data\CreateChallengeGroupData;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;

readonly class CreateChallengeGroupChallengeGroupUseCase extends ChallengeGroupUseCase
{
    public function execute(int $user_id, CreateChallengeGroupDTO $creation_data): ChallengeGroupEntity
    {
        return $this->service->create(new CreateChallengeGroupData(
            $creation_data->name,
            $creation_data->end_date,
            $user_id
        ));
    }
}
