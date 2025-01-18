<?php

declare(strict_types=1);

namespace App\Application\Auth\DTOs;

use App\Application\Shared\DTO;

final class UserDTO extends DTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
    ) {}
}
