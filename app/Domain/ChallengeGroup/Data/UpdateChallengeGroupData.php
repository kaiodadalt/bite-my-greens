<?php
declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Data;

use DateTime;
use InvalidArgumentException;

final readonly class UpdateChallengeGroupData
{
    public function __construct(
        private int $id,
        private ?string $name = null,
        private ?DateTime $end_date = null
    ) {
        if (!is_null($this->name) && strlen($name) === 0) {
            throw new InvalidArgumentException('Name cannot be empty');
        }

        if (!is_null($this->end_date) && $end_date < new DateTime()) {
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

    public function getEndDate(): ?DateTime
    {
        return $this->end_date;
    }
}
