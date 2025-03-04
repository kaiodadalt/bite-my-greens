<?php

declare(strict_types=1);

namespace App\Domain\Auth\Entities;

use App\Domain\Shared\Entity;

final readonly class UserEntity implements Entity
{
    public function __construct(
        private int $id,
        private string $name,
        private string $email,
        private ?int $total_score = null,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTotalScore(): ?int
    {
        return $this->total_score;
    }
}
