<?php

namespace App\Application\ChallengeGroups\DTO;

use App\Application\Shared\DTO;

class ChallengeGroupDTO extends DTO
{
    public function __construct(
        public readonly ?int     $id = null,
        public readonly ?string  $name = null,
        public readonly ?string  $end_date = null,
        public readonly ?int     $created_by = null
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'end_date' => $this->end_date,
            'created_by' => $this->created_by,
        ];
    }
}
