<?php

namespace App\Application\ChallengeGroups\DTOs;

use App\Application\Shared\DTO;

readonly class DeleteChallengeGroupDTO implements DTO
{
    public function __construct(
        public int $id
    ) {}
}
