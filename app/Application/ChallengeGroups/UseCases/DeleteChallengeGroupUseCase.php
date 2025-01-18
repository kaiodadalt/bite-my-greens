<?php

declare(strict_types=1);

namespace App\Application\ChallengeGroups\UseCases;

use App\Domain\ChallengeGroup\Exceptions\ChallengeGroupNotFound;

final readonly class DeleteChallengeGroupUseCase extends ChallengeGroupUseCase
{
    /**
     * @throws ChallengeGroupNotFound
     */
    public function execute(int $user_id, int $challenge_group_id): bool
    {
        return $this->service->delete($user_id, $challenge_group_id);
    }
}
