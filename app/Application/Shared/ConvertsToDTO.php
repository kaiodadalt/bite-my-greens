<?php

declare(strict_types=1);

namespace App\Application\Shared;

interface ConvertsToDTO
{
    public function toDTO(): DTO;
}
