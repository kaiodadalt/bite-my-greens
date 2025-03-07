<?php

declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Entities;

use App\Domain\Shared\Helpers\Collection;

/**
 * @extends Collection<int, ChallengeGroupEntity>
 */
final class ChallengeGroupEntityCollection extends Collection
{
    public function __construct(ChallengeGroupEntity ...$challenge_groups)
    {
        parent::__construct();
        foreach ($challenge_groups as $challenge_group) {
            $this->addChallengeGroup($challenge_group);
        }
    }

    public function addChallengeGroup(ChallengeGroupEntity $challenge_group): void
    {
        $this->addWithKey($challenge_group->getId(), $challenge_group);
    }

    public function findById(int $id): ?ChallengeGroupEntity
    {
        return $this->all()->get($id, null);
    }

    public function removeById(int $id): bool
    {
        if ($this->all()->hasKey($id)) {
            $this->all()->remove($id);

            return true;
        }

        return false;
    }
}
