<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Requests;

use App\Application\Shared\DTO;

interface ConvertsToDTO
{
    public function toDTO(): DTO;
}
