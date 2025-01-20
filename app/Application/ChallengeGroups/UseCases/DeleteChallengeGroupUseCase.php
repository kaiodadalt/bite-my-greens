<?php

declare(strict_types=1);

namespace App\Application\ChallengeGroups\UseCases;

use App\Domain\ChallengeGroup\Exceptions\ChallengeGroupNotFoundException;

final readonly class DeleteChallengeGroupUseCase extends ChallengeGroupUseCase
{
    /**
     * @throws ChallengeGroupNotFoundException
     */
    public function execute(int $user_id, int $challenge_group_id): bool
    {
        return $this->service->delete($user_id, $challenge_group_id);
    }
}
