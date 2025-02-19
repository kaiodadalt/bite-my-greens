<?php

declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Data;

final readonly class ExitChallengeData
{
    public function __construct(
        private int $challenge_group_id,
        private int $user_id,
    ) {}

    public function getChallengeGroupId(): int
    {
        return $this->challenge_group_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }
}
