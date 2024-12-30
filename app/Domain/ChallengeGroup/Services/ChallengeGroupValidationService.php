<?php

namespace App\Domain\ChallengeGroup\Services;

use App\Domain\DomainException;

class ChallengeGroupValidationService
{
    /**
     * @throws DomainException
     */
    public function validateEndDate(string $end_date): void
    {
        if (strtotime($end_date) < time()) {
            throw new DomainException("End date must be in the future.");
        }
    }
}
