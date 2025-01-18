<?php

declare(strict_types=1);

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\ChallengeGroups\DTO\UpdateChallengeGroupDTO;
use App\Domain\ChallengeGroup\Data\UpdateChallengeGroupData;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Exceptions\ChallengeGroupNotFound;

final readonly class UpdateChallengeGroupUseCase extends ChallengeGroupUseCase
{
    /**
     * @throws ChallengeGroupNotFound
     */
    public function execute(int $user_id, UpdateChallengeGroupDTO $challenge_group_dto): ChallengeGroupEntity
    {
        return $this->service->update(new UpdateChallengeGroupData(
            $challenge_group_dto->id,
            $user_id,
            $challenge_group_dto->name,
            $challenge_group_dto->end_date,
        ));
    }
}
