<?php

namespace App\Application\Auth\DTOs;

use App\Application\Shared\DTO;

readonly class UserDTO implements DTO
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
    ) {}
}
