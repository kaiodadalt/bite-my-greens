<?php

namespace App\Infrastructure\Http\Requests;

use App\Application\DTO;

interface ConvertsToDTO
{
    public function toDto(): DTO;
}
