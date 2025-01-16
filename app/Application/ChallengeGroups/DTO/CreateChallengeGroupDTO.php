<?php
declare(strict_types=1);

namespace App\Application\ChallengeGroups\DTO;

use App\Application\Shared\DTO;
use DateTimeImmutable;

class CreateChallengeGroupDTO extends DTO
{
    public function __construct(
        public readonly string  $name,
        public readonly DateTimeImmutable  $end_date,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'end_date' => $this->end_date,
        ];
    }
}
