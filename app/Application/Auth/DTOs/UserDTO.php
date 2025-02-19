<?php

declare(strict_types=1);

namespace App\Application\Auth\DTOs;

use App\Application\Shared\DTO;

final readonly class UserDTO extends DTO
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
    ) {}
}
