<?php

namespace App\Domain\ChallengeGroup\Services;

use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\Shared\Exceptions\DomainException;

class ValidateChallengeGroupService
{
    /**
     * @throws DomainException
     */
    public function validate(ChallengeGroupEntity $challenge_group): void
    {
        if($challenge_group->getEndDate()){
            $this->validateEndDate($challenge_group);
        }
    }

    /**
     * @throws DomainException
     */
    private function validateEndDate(ChallengeGroupEntity $challenge_group): void
    {
        if (strtotime($challenge_group->getEndDate()) < time()) {
            throw new DomainException("End date must be in the future.");
        }
    }
}
