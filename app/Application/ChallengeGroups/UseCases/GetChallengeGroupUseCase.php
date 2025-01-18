<?php

declare(strict_types=1);

namespace App\Application\ChallengeGroups\UseCases;

use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Exceptions\ChallengeGroupNotFound;

final readonly class GetChallengeGroupUseCase extends ChallengeGroupUseCase
{
    /**
     * @throws ChallengeGroupNotFound
     */
    public function execute(int $user_id, int $challenge_group_id): ChallengeGroupEntity
    {
        return $this->service->get($user_id, $challenge_group_id);
    }
}
