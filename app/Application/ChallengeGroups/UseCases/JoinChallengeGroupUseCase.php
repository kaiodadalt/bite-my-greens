<?php

declare(strict_types=1);

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\ChallengeGroups\Contracts\ParticipantAction;
use App\Domain\ChallengeGroup\Data\JoinChallengeData;

final readonly class JoinChallengeGroupUseCase extends ChallengeGroupUseCase implements ParticipantAction
{
    public function execute(int $user_id, int $challenge_group_id): void
    {
        $this->participant_service->joinChallenge(new JoinChallengeData(
            $challenge_group_id,
            $user_id
        ));
    }
}
