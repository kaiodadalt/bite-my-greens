<?php

declare(strict_types=1);

namespace App\Application\ChallengeGroups\DTO;

use App\Application\Shared\DTO;
use DateTimeImmutable;

final readonly class CreateChallengeGroupDTO extends DTO
{
    public function __construct(
        public string $name,
        public DateTimeImmutable $end_date,
    ) {}
}
