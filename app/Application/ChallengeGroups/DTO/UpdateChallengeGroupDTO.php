<?php
declare(strict_types=1);

namespace App\Application\ChallengeGroups\DTO;

use App\Application\Shared\DTO;
use DateTimeImmutable;

class UpdateChallengeGroupDTO extends DTO
{
    public function __construct(
        public readonly int      $id,
        public readonly ?string  $name = null,
        public readonly ?DateTimeImmutable  $end_date = null,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'end_date' => $this->end_date,
        ];
    }
}
