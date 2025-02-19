<?php

declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Services;

use App\Domain\ChallengeGroup\Contracts\ChallengeGroupUserRepository;
use App\Domain\ChallengeGroup\Data\ExitChallengeData;
use App\Domain\ChallengeGroup\Data\JoinChallengeData;

final readonly class ChallengeGroupUserService
{
    public function __construct(
        private ChallengeGroupUserRepository $repository,
    ) {}

    public function joinChallenge(JoinChallengeData $data): void
    {
        $this->repository->joinChallenge($data);
    }

    public function exitChallenge(ExitChallengeData $data): void
    {
        $this->repository->exitChallenge($data);
    }
}
