<?php

declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Entities;

use App\Domain\Shared\Entity;
use DateTimeImmutable;

final readonly class ChallengeGroupPostEntity implements Entity
{
    public function __construct(
        private int $challenge_group_id,
        private int $user_id,
        private string $description,
        private string $image,
        private ?int $score,
        private DateTimeImmutable $created_at,
        private DateTimeImmutable $updated_at,
    ) {}

    public function getChallengeGroupId(): int
    {
        return $this->challenge_group_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getScore(): ?int
    {
        return $this->score;
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
