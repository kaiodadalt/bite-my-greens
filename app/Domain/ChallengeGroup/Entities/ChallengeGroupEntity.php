<?php

declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Entities;

use App\Domain\Auth\Entities\UserEntity;
use App\Domain\Auth\Entities\UserEntityCollection;
use App\Domain\Shared\Entity;
use DateTimeImmutable;

final readonly class ChallengeGroupEntity implements Entity
{
    public function __construct(
        private int $id,
        private string $name,
        private DateTimeImmutable $end_date,
        private UserEntity $owner,
        private UserEntityCollection $participants,
        private ChallengeGroupPostEntityCollection $posts,
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

    public function getOwner(): UserEntity
    {
        return $this->owner;
    }

    public function hasOwner(int $user_id): bool
    {
        return $this->owner->getId() === $user_id;
    }

    public function getParticipants(): UserEntityCollection
    {
        return $this->participants;
    }

    public function getPosts(): ChallengeGroupPostEntityCollection
    {
        return $this->posts;
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
