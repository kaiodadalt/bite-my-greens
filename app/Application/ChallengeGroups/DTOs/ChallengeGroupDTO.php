<?php

namespace App\Application\ChallengeGroups\DTOs;

use App\Application\Shared\DTO;

readonly class ChallengeGroupDTO implements DTO
{
    public function __construct(
        public ?int     $id = null,
        public ?string  $name = null,
        public ?string  $end_date = null,
        public ?int     $created_by = null
    ) {}
}
