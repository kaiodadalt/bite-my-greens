<?php

namespace App\Domain\ChallengeGroup\Entities;

use App\Domain\Shared\Entity;
use DateTime;

class ChallengeGroupEntity implements Entity
{
    public function __construct(
        private ?int     $id = null,
        private ?string  $name = null,
        private ?DateTime  $end_date = null,
        private ?int     $created_by = null,
        private ?string  $created_at = null,
        private ?string  $updated_at = null,
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEndDate(): ?DateTime
    {
        return $this->end_date;
    }

    public function getOwnerId(): int
    {
        return $this->created_by;
    }

    public function setOwnerId(int $created_by): self
    {
        $this->created_by = $created_by;
        return $this;
    }

    public function hasOwner(int $user_id): bool
    {
        return $this->created_by === $user_id;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): self
    {
        $this->updated_at = $updated_at;
        return $this;
    }
}
