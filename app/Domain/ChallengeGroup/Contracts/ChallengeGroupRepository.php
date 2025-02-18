<?php

declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Contracts;

use App\Domain\ChallengeGroup\Data\CreateChallengeGroupData;
use App\Domain\ChallengeGroup\Data\UpdateChallengeGroupData;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;

interface ChallengeGroupRepository
{
    public function create(CreateChallengeGroupData $challenge_group_data): ChallengeGroupEntity;

    public function update(UpdateChallengeGroupData $challenge_group_data): ChallengeGroupEntity;

    public function delete(int $id, int $created_by): bool;

    public function hasMember(int $id, int $user_id): bool;

    public function find(int $id): ?ChallengeGroupEntity;

    public function findOrFail(int $id, int $created_by): ChallengeGroupEntity;
}
