<?php

declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Entities;

use App\Domain\Shared\Entity;
use DateTimeImmutable;

final readonly class ChallengeGroupEntity implements Entity
{
    public function __construct(
        private int $id,
        private string $name,
        private DateTimeImmutable $end_date,
        private int $created_by,
        private DateTimeImmutable $created_at,
        private DateTimeImmutable $updated_at,
    ) {}

    public function getId(): int
    {
        return $this->id;
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

    public function hasOwner(int $user_id): bool
    {
        return $this->created_by === $user_id;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updated_at;
    }
}
