<?php

namespace App\Domain\ChallengeGroup\Contracts;

use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;

interface ChallengeGroupRepository
{
    public function save(ChallengeGroupEntity $challenge_group): ChallengeGroupEntity;
}
