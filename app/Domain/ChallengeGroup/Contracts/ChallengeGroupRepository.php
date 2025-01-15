<?php
declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Contracts;

use App\Domain\ChallengeGroup\Data\CreateChallengeGroupData;
use App\Domain\ChallengeGroup\Data\UpdateChallengeGroupData;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;

interface ChallengeGroupRepository
{
    public function create(CreateChallengeGroupData $challenge_group_data): ChallengeGroupEntity;
    public function update(UpdateChallengeGroupData $challenge_group): ChallengeGroupEntity;
    public function delete(ChallengeGroupEntity $challenge_group): bool;
    public function hasMember(ChallengeGroupEntity $challenge_group, int $user_id): bool;
    public function find(int $challenge_group_id): ?ChallengeGroupEntity;
    public function findOrFail(int $id, int $user_id): ChallengeGroupEntity;
}
