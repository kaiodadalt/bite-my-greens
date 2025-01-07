<?php

namespace App\Application\ChallengeGroups\DTOs;

use App\Application\Shared\DTO;

readonly class CreateChallengeGroupDTO implements DTO
{
    public function __construct(
        public string $name,
        public string $end_date,
        public int    $created_by,
    ) {}
}
