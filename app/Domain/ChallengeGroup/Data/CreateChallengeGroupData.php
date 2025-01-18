<?php

declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Data;

use DateTimeImmutable;
use InvalidArgumentException;

final readonly class CreateChallengeGroupData
{
    public function __construct(
        private string $name,
        private DateTimeImmutable $end_date,
        private int $created_by
    ) {
        if (mb_strlen($name) === 0) {
            throw new InvalidArgumentException('Name cannot be empty');
        }

        if ($end_date < new DateTimeImmutable) {
            throw new InvalidArgumentException('End date cannot be in the past');
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEndDate(): DateTimeImmutable
    {
        return $this->end_date;
    }

    public function getOwnerId(): int
    {
        return $this->created_by;
    }
}
