<?php
declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Data;

use DateTimeImmutable;
use InvalidArgumentException;

final readonly class UpdateChallengeGroupData
{
    public function __construct(
        private int $id,
        private int $created_by,
        private ?string $name = null,
        private ?DateTimeImmutable $end_date = null,
    ) {
        if (!is_null($this->name) && empty($name)) {
            throw new InvalidArgumentException('Name cannot be empty');
        }

        if (!is_null($this->end_date) && $end_date < new DateTimeImmutable()) {
            throw new InvalidArgumentException('End date cannot be in the past');
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEndDate(): ?DateTimeImmutable
    {
        return $this->end_date;
    }

    public function getOwnerId(): int
    {
        return $this->created_by;
    }
}
