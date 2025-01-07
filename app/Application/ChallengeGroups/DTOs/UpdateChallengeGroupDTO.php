<?php

namespace App\Application\ChallengeGroups\DTOs;

use App\Application\Shared\DTO;

readonly class UpdateChallengeGroupDTO implements DTO
{
    public function __construct(
        public int      $id,
        public ?string  $name = null,
        public ?string  $end_date = null,
        public int      $created_by
    ) {}
}
