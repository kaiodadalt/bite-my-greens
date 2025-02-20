<?php

declare(strict_types=1);

namespace App\Application\ChallengeGroups\Contracts;

interface ParticipantAction
{
    public function execute(int $user_id, int $challenge_group_id): void;
}
