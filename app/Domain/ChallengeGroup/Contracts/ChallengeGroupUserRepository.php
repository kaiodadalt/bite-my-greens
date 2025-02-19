<?php

declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Contracts;

use App\Domain\ChallengeGroup\Data\ExitChallengeData;
use App\Domain\ChallengeGroup\Data\JoinChallengeData;

interface ChallengeGroupUserRepository
{
    public function joinChallenge(JoinChallengeData $data): void;

    public function exitChallenge(ExitChallengeData $data): void;
}
