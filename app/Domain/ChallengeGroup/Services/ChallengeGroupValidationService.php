<?php

namespace App\Domain\ChallengeGroup\Services;

use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\DomainException;

class ChallengeGroupValidationService
{
    /**
     * @throws DomainException
     */
    public function validate(ChallengeGroupEntity $challenge_group): void
    {
        $this->validateEndDate($challenge_group);
    }

    /**
     * @throws DomainException
     */
    private function validateEndDate(ChallengeGroupEntity $challenge_group): void
    {
        if (strtotime($challenge_group->end_date) < time()) {
            throw new DomainException("End date must be in the future.");
        }
    }
}
