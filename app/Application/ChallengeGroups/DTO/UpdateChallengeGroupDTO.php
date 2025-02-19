<?php

declare(strict_types=1);

namespace App\Application\ChallengeGroups\DTO;

use App\Application\Shared\DTO;
use DateTimeImmutable;

final readonly class UpdateChallengeGroupDTO extends DTO
{
    public function __construct(
        public int $id,
        public ?string $name = null,
        public ?DateTimeImmutable $end_date = null,
    ) {}
}
