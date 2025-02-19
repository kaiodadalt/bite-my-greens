<?php

declare(strict_types=1);

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\ChallengeGroups\DTO\CreateChallengeGroupDTO;
use App\Domain\ChallengeGroup\Data\CreateChallengeGroupData;
use App\Domain\ChallengeGroup\Data\JoinChallengeData;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;

final readonly class CreateChallengeGroupUseCase extends ChallengeGroupUseCase
{
    public function execute(int $user_id, CreateChallengeGroupDTO $creation_data): ChallengeGroupEntity
    {
        $challenge_group_entity = $this->service->create(new CreateChallengeGroupData(
            $creation_data->name,
            $creation_data->end_date,
            $user_id
        ));
        $this->participant_service->joinChallenge(new JoinChallengeData(
            $challenge_group_entity->getId(),
            $user_id
        ));

        return $challenge_group_entity;
    }
}
