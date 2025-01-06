<?php

namespace App\Domain\ChallengeGroup\Contracts;

use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;

interface ChallengeGroupRepository
{
    public function create(ChallengeGroupEntity $challenge_group): ChallengeGroupEntity;
    public function update(ChallengeGroupEntity $challenge_group): ChallengeGroupEntity;
    public function findOrFail(int $id, int $user_id): ChallengeGroupEntity;
}
