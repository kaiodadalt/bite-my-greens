<?php

declare(strict_types=1);

namespace App\Application\ChallengeGroups\DTO;

use App\Application\Shared\DTO;
use DateTimeImmutable;

final class UpdateChallengeGroupDTO extends DTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $name = null,
        public readonly ?DateTimeImmutable $end_date = null,
    ) {}
}
