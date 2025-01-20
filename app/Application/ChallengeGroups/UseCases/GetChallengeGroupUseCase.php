<?php

declare(strict_types=1);

namespace App\Application\ChallengeGroups\UseCases;

use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Exceptions\ChallengeGroupNotFoundException;

final readonly class GetChallengeGroupUseCase extends ChallengeGroupUseCase
{
    /**
     * @throws ChallengeGroupNotFoundException
     */
    public function execute(int $user_id, int $challenge_group_id): ChallengeGroupEntity
    {
        return $this->service->get($user_id, $challenge_group_id);
    }
}
