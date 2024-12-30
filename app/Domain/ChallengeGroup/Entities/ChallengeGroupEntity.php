<?php

namespace App\Domain\ChallengeGroup\Entities;

use App\Domain\Entity;

class ChallengeGroupEntity implements Entity
{
    public function __construct(
        public ?int     $id = null,
        public string   $name,
        public string   $end_date,
        public int      $created_by,
        public ?string  $created_at = null,
        public ?string  $updated_at = null,
    ) {}
}
