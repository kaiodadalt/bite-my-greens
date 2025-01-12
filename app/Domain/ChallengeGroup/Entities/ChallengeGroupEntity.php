<?php
declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Entities;

use App\Domain\Shared\Entity;
use DateTime;

class ChallengeGroupEntity implements Entity
{
    public function __construct(
        private readonly int    $id,
        private string          $name,
        private DateTime        $end_date,
        private readonly int    $created_by,
        private readonly string $created_at,
        private readonly string $updated_at,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getEndDate(): DateTime
    {
        return $this->end_date;
    }

    public function setEndDate(DateTime $end_date): self
    {
        $this->end_date = $end_date;
        return $this;
    }

    public function getOwnerId(): int
    {
        return $this->created_by;
    }

    public function hasOwner(int $user_id): bool
    {
        return $this->created_by === $user_id;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }
}
